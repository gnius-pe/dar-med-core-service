<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Models\Doctor\Doctor;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Doctor\Specialitie;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\Appointment\Appointment;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\Appointment\AppointmentCollection;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAnyDoctor', Doctor::class);
        $search = $request->search;

        $query = User::with(['roles', 'specialitie'])
            ->whereHas("roles", function ($q) {
                $q->where("name", "like", "%DOCTOR%");
            });

        if (!empty($search)) {
            $query->where(DB::raw("CONCAT(users.name,' ',IFNULL(users.surname,''),' ',users.email)"), "like", "%" . $search . "%");
        }

        $users = $query->orderBy("id", "desc")->get();

        return response()->json([
            "users" => $users,
        ]);
    }

    public function profile($id): JsonResponse
    {
        $this->authorize('profileDoctor', Doctor::class);
        $cachedRecord = Redis::get('profile_doctor_#' . $id);
        if (isset($cachedRecord)) {
            $data_doctor = json_decode($cachedRecord, FALSE);
        } else {
            $user = User::findOrFail($id);
            $num_appointment = Appointment::where("doctor_id", $id)->count();
            $money_of_appointments = Appointment::where("doctor_id", $id)->sum("amount");
            $num_appointment_pendings = Appointment::where("doctor_id", $id)->where("status", 1)->count();

            $appointment_pendings = Appointment::where("doctor_id", $id)->where("status", 1)->get();
            $appointments = Appointment::where("doctor_id", $id)->get();

            $data_doctor = [
                "num_appointment" => $num_appointment,
                "money_of_appointments" => $money_of_appointments,
                "num_appointment_pendings" => $num_appointment_pendings,
                "doctor" => UserResource::make($user),
                "appointment_pendings" => AppointmentCollection::make($appointment_pendings),
                "appointments" => $appointments->map(function ($appointment) {
                    return [
                        "id" => $appointment->id,
                        "patient" => [
                            "id" => $appointment->patient->id,
                            "full_name" => $appointment->patient->name . ' ' . $appointment->patient->surname,
                            "avatar" => $appointment->patient->avatar ? env("APP_URL") . "storage/" . $appointment->patient->avatar : 'https://cdn-icons-png.flaticon.com/512/1430/1430453.png',
                        ],
                        "doctor" => [
                            "id" => $appointment->doctor->id,
                            "full_name" => $appointment->doctor->name . ' ' . $appointment->doctor->surname,
                            "avatar" => $appointment->doctor->avatar ? env("APP_URL") . "storage/" . $appointment->doctor->avatar : NULL,
                        ],
                        "date_appointment" => $appointment->date_appointment,
                        "date_appointment_format" => Carbon::parse($appointment->date_appointment)->format("d M Y"),
                        "appointment_attention" => $appointment->attention ? [
                            "id" => $appointment->attention->id,
                            "description" => $appointment->attention->description,
                            "receta_medica" => $appointment->attention->receta_medica ? json_decode($appointment->attention->receta_medica) : [],
                            "created_at" => $appointment->attention->created_at->format("Y-m-d h:i A"),
                        ] : NULL,
                        "amount" => $appointment->amount,
                        "status_pay" => $appointment->status_pay,
                        "status" => $appointment->status,
                    ];
                }),
            ];
            Redis::set('profile_doctor_#' . $id, json_encode($data_doctor), 'EX', 3600);
        }

        return response()->json($data_doctor);
    }

    public function config(): JsonResponse
    {
        $roles = Role::where("name", "like", "%DOCTOR%")->get();

        $specialities = Specialitie::where("state", 1)->get();

        return response()->json([
            "roles" => $roles,
            "specialities" => $specialities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorize('createDoctor', Doctor::class);

        $users_is_valid = User::where("email", $request->email)->first();

        if ($users_is_valid) {
            return response()->json([
                "message" => 403,
                "message_text" => "EL USUARIO CON ESTE EMAIL YA EXISTE"
            ]);
        }

        if ($request->hasFile("imagen")) {
            $path = Storage::putFile("staffs", $request->file("imagen"));
            $request->request->add(["avatar" => $path]);
        }

        if ($request->password) {
            $request->request->add(["password" => bcrypt($request->password)]);
        }

        $date_clean = preg_replace('/\(.*\)|[A-Z]{3}-\d{4}/', '', $request->birth_date);

        $request->request->add(["birth_date" => Carbon::parse($date_clean)->format("Y-m-d h:i:s")]);

        $user = User::create($request->all());

        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role);

        return response()->json([
            "message" => 200
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $this->authorize('viewDoctor', Doctor::class);
        $user = User::findOrFail($id);

        return response()->json([
            "doctor" => UserResource::make($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $this->authorize('updateDoctor', Doctor::class);

        $users_is_valid = User::where("id", "<>", $id)->where("email", $request->email)->first();

        if ($users_is_valid) {
            return response()->json([
                "message" => 403,
                "message_text" => "EL USUARIO CON ESTE EMAIL YA EXISTE"
            ]);
        }

        $user = User::findOrFail($id);

        if ($request->hasFile("imagen")) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $path = Storage::putFile("staffs", $request->file("imagen"));
            $request->request->add(["avatar" => $path]);
        }

        if ($request->password) {
            $request->request->add(["password" => bcrypt($request->password)]);
        }

        $date_clean = preg_replace('/\(.*\)|[A-Z]{3}-\d{4}/', '', $request->birth_date);

        $request->request->add(["birth_date" => Carbon::parse($date_clean)->format("Y-m-d h:i:s")]);

        $cachedRecord = Redis::get('profile_doctor_#' . $id);
        if (isset($cachedRecord)) {
            Redis::del('profile_doctor_#' . $id);
        }
        $user->update($request->all());

        if ($request->role_id != $user->roles()->first()->id) {
            $role_old = Role::findOrFail($user->roles()->first()->id);
            $user->removeRole($role_old);

            $role_new = Role::findOrFail($request->role_id);
            $user->assignRole($role_new);
        }

        return response()->json([
            "message" => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->authorize('deleteDoctor', Doctor::class);
        $user = User::findOrFail($id);
        $user->delete();
        $cachedRecord = Redis::get('profile_doctor_#' . $id);
        if (isset($cachedRecord)) {
            Redis::del('profile_doctor_#' . $id);
        }
        return response()->json([
            "message" => 200
        ]);
    }
}

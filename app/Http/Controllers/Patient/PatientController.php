<?php

namespace App\Http\Controllers\Patient;

use App\Http\Requests\PatientRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\Appointment\Appointment;
use App\Http\Resources\Patient\PatientResource;
use App\Http\Resources\Appointment\AppointmentCollection;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Patient::class);

        $search = $request->query('search');
        $patients = Patient::query()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('identification_number', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return response()->json($patients);
    }

    public function profile($id)
    {

        $this->authorize('profile', Patient::class);
        $cachedRecord = Redis::get('profile_patient_#' . $id);
        $data_patient = [];
        if (isset($cachedRecord)) {
            $data_patient = json_decode($cachedRecord, FALSE);
        } else {

            $patient = Patient::findOrFail($id);

            $num_appointment = Appointment::where("patient_id", $id)->count();
            $money_of_appointments = Appointment::where("patient_id", $id)->sum("amount");
            $num_appointment_pendings = Appointment::where("patient_id", $id)->where("status", 1)->count();

            $appointment_pendings = Appointment::where("patient_id", $id)->where("status", 1)->get();
            $appointments = Appointment::where("patient_id", $id)->get();
            $data_patient = [
                "num_appointment" => $num_appointment,
                "money_of_appointments" => $money_of_appointments,
                "num_appointment_pendings" => $num_appointment_pendings,
                "patient" => PatientResource::make($patient),
                "appointment_pendings" => AppointmentCollection::make($appointment_pendings),
                "appointments" => $appointments->map(function ($appointment) {
                    return [
                        "id" => $appointment->id,
                        "patient" => [
                            "id" => $appointment->patient->id,
                            "full_name" => $appointment->patient->name . ' ' . $appointment->patient->surname,
                            "avatar" => $appointment->patient->avatar ? env("APP_URL") . "storage/" . $appointment->patient->avatar : NULL,
                        ],
                        "doctor" => [
                            "id" => $appointment->doctor->id,
                            "full_name" => $appointment->doctor->name . ' ' . $appointment->doctor->surname,
                            "avatar" => $appointment->doctor->avatar ? env("APP_URL") . "storage/" . $appointment->doctor->avatar : NULL,
                        ],
                        "date_appointment" => $appointment->date_appointment,
                        "date_appointment_format" => Carbon::parse($appointment->date_appointment)->format("d M Y"),
                        "format_hour_start" => Carbon::parse(date("Y-m-d") . ' ' . $appointment->doctor_schedule_join_hour->doctor_schedule_hour->hour_start)->format("h:i A"),
                        "format_hour_end" => Carbon::parse(date("Y-m-d") . ' ' . $appointment->doctor_schedule_join_hour->doctor_schedule_hour->hour_end)->format("h:i A"),
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
            Redis::set('profile_patient_#' . $id, json_encode($data_patient), 'EX', 3600);
        }


        return response()->json($data_patient);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        $patient = Patient::create($request->validated());

        return response()->json([
            'message' => 'Patient created successfully',
            'data' => $patient
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $this->authorize('view', Patient::class);
        $patient = Patient::findOrFail($id);

        return response()->json([
            "patient" => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, string $id): JsonResponse
    {
        $this->authorize('update', Patient::class);

        $patient = Patient::findOrFail($id);

        $existingPatient = Patient::where('id', '<>', $id)
            ->where('identification_number', $request->identification_number)
            ->first();

        if ($existingPatient) {
            return response()->json([
                'message' => 'Patient with the same identification number already exists.',
            ], 409);
        }

        $patient->update($request->validated());

        return response()->json([
            'message' => 'Patient updated successfully',
            'data' => $patient,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {

        $this->authorize('delete', Patient::class);

        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json([
            "message" => 200
        ]);
    }

    public function getPatientDataWithAppointments($patientId): JsonResponse
    {
        $patientData = DB::select("
        SELECT
            p.id AS patient_id,
            p.first_name,
            p.last_name,
            p.email,
            p.birth_date,
            p.first_phone,
            p.second_phone,
            p.gender,
            p.identification_number,
            p.message,
            p.spiritual_support,
            p.permission_to_call,
            p.medical_examination,
            a.id AS appointment_id,
            a.date_appointment,
            a.status,
            a.status_pay,
            a.amount,
            d.name AS doctor_name,
            d.surname AS doctor_surname,
            s.name AS specialty_name
        FROM patients p
        LEFT JOIN appointments a ON p.id = a.patient_id
        LEFT JOIN users d ON a.doctor_id = d.id
        LEFT JOIN specialities s ON a.specialitie_id = s.id
        WHERE p.id = ?
        AND a.deleted_at IS NULL
        AND p.deleted_at IS NULL
    ", [$patientId]);

        if (empty($patientData)) {
            return response()->json(['message' => 'Patient or appointments not found'], 404);
        }

        $response = [
            'patient' => [
                'id' => $patientData[0]->patient_id,
                'name' => $patientData[0]->first_name . ' ' . $patientData[0]->last_name,
                'email' => $patientData[0]->email,
                'birth_date' => $patientData[0]->birth_date,
                'first_phone' => $patientData[0]->first_phone,
                'second_phone' => $patientData[0]->second_phone,
                'gender' => $patientData[0]->gender,
                'identification_number' => $patientData[0]->identification_number,
                'message' => $patientData[0]->message,
                'spiritual_support' => $patientData[0]->spiritual_support,
                'permission_to_call' => $patientData[0]->permission_to_call,
                'medical_examination' => $patientData[0]->medical_examination,
            ],
            'appointments' => array_map(function ($data) {
                return [
                    'id' => $data->appointment_id,
                    'date' => $data->date_appointment,
                    'status' => $data->status,
                    'status_pay' => $data->status_pay,
                    'amount' => $data->amount,
                    'doctor_name' => $data->doctor_name . ' ' . $data->doctor_surname,
                    'specialty' => $data->specialty_name,
                ];
            }, $patientData),
        ];

        return response()->json($response);
    }
}

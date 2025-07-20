<?php

namespace App\Http\Controllers\Appointment;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Patient\Patient;
use App\Models\Doctor\Specialitie;
use App\Http\Controllers\Controller;
use App\Models\Patient\PatientPerson;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\AppointmentPay;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Http\Resources\Appointment\AppointmentCollection;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Appointment::class);
        $specialities_id = $request->specialitie_id;
        $name_doctor = $request->search;
        $date = $request->date;
        $user = auth("api")->user();

        $appointments = Appointment::filterAdvance($specialities_id,$name_doctor,$date,$user)->orderBy("id","desc")
                        ->paginate(20);

        return response()->json([
            "total" => $appointments->total(),
            "appointments" => AppointmentCollection::make($appointments),
        ]);
    }

    public function config(): JsonResponse
    {

        $specialities = Specialitie::where("state",1)->get();

        return response()->json([
            "specialities" => $specialities
        ]);
    }

    public function calendar(Request $request): JsonResponse
    {

        $specialities_id = $request->specialitie_id;
        $search_doctor = $request->search_doctor;
        $search_patient = $request->search_patient;
        $user = auth("api")->user();

        $appointments = Appointment::filterAdvancePay($specialities_id,$search_doctor,$search_patient,null,null,$user)
                    ->orderBy("id","desc")
                    ->get();

        return response()->json([
            "appointments" => $appointments->map(function($appointment) {
                return [
                    "id" => $appointment->id,
                    "title" => "CITA MEDICA - ".($appointment->doctor->name. ' '.$appointment->doctor->surname)." - ".$appointment->specialitie->name
                ];
            })
        ]);
    }

    public function query_patient(Request $request){
        $identification_number = $request->get("identification_number");

        $patient = Patient::where("identification_number",$identification_number)->first();
        if(!$patient){
            return response()->json([
                "message" => 403,
            ]);
        }
        return response()->json([
            "message" => 200,
            "first_name" => $patient->first_name,
            "last_name" => $patient->last_name,
            "first_phone" => $patient->first_phone,
            "identification_number" => $patient->identification_number,

        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', Appointment::class);

        // Intentamos buscar al paciente por su documento
        $patient = Patient::where("identification_number", $request->identification_number)->first();

        if (!$patient) {
            // Si el paciente no existe, lo creamos y añadimos la relación de acompañante
            $patient = Patient::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "first_phone" => $request->first_phone,
                "identification_number" => $request->identification_number,
            ]);

            PatientPerson::create([
                "patient_id" => $patient->id,
                "name_companion" => $request->name_companion?? null,
                "surname_companion" => $request->surname_companion?? null,
            ]);
        } else {
            // Si el paciente existe, verificamos si la relación `person` existe
            if ($patient->person) {
                // Si la relación `person` existe, la actualizamos
                $patient->person->update([
                    "name_companion" => $request->name_companion?? null,
                    "surname_companion" => $request->surname_companion?? null,
                ]);
            } else {
                // Si la relación `person` no existe, la creamos
                PatientPerson::create([
                    "patient_id" => $patient->id,
                    "name_companion" => $request->name_companion?? null,
                    "surname_companion" => $request->surname_companion?? null,
                ]);
            }
        }

        // Creamos la cita
        $appointment = Appointment::create([
            "doctor_id" => $request->doctor_id,
            "patient_id" => $patient->id,
            "date_appointment" => Carbon::parse($request->date_appointment)->format("Y-m-d H:i:s"),
            "specialitie_id" => $request->specialitie_id,
            "user_id" => auth("api")->user()->id,
            "amount" => $request->amount,
            "status_pay" => $request->amount != $request->amount_add ? 2 : 1,
        ]);

        // Creamos el pago de la cita
        AppointmentPay::create([
            "appointment_id" => $appointment->id,
            "amount" => $request->amount_add,
            "method_payment" => $request->method_payment,
        ]);

        // Retornamos una respuesta JSON de éxito
        return response()->json([
            "message" => 200,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $appointment = Appointment::findOrFail($id);
    //    dd($appointment);
       $this->authorize('view',$appointment);
       return response()->json([
        "appointment" => AppointmentResource::make($appointment)
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {

        $appointment = Appointment::findOrFail($id);
        $this->authorize('update',$appointment);

        if($appointment->payments->sum("amount") > $request->amount){
            return response()->json([
                "message" => 403,
                "message_text" => "LOS PAGOS INGRESADOS SUPERAN AL NUEVO MONTO QUE QUIERE GUARDAR"
            ]);
        }

        $appointment->update([
            "doctor_id" => $request->doctor_id,
            "date_appointment" => Carbon::parse($request->date_appointment)->format("Y-m-d h:i:s"),
            "specialitie_id" => $request->specialitie_id,
            "amount" => $request->amount,
            "status_pay" => $appointment->payments->sum("amount")  != $request->amount ? 2 : 1,
        ]);

        return response()->json([
            "message" => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->authorize('delete',$appointment);
        $appointment->delete();
       return response()->json([
        "message" => 200,
       ]);
    }
}

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
use App\Services\DoctorTicketService;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Http\Resources\Appointment\AppointmentCollection;

class AppointmentController extends Controller
{
    protected $doctorTicketService;

    public function __construct(DoctorTicketService $doctorTicketService)
    {
        $this->doctorTicketService = $doctorTicketService;
    }

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

    /**
     * Nuevo método para filtrar doctores disponibles por fecha y especialidad
     */
    public function filter(Request $request): JsonResponse
    {
        $this->authorize('filter', Appointment::class);

        $date_appointment = $request->date_appointment;
        $specialitie_id = $request->specialitie_id;

        if (!$date_appointment) {
            return response()->json([
                "message" => 422,
                "message_text" => "La fecha de la cita es requerida"
            ], 422);
        }

        // Obtener doctores con cupos disponibles para la fecha especificada
        $availableDoctors = $this->doctorTicketService->getAvailableDoctors($date_appointment, $specialitie_id);

        $doctors = $availableDoctors->map(function ($ticket) {
            return [
                "doctor" => [
                    "id" => $ticket->doctor->id,
                    "full_name" => $ticket->doctor->name . ' ' . $ticket->doctor->surname,
                    "specialitie" => [
                        "id" => $ticket->doctor->specialitie->id,
                        "name" => $ticket->doctor->specialitie->name,
                    ],
                    "avatar_url" => $ticket->doctor->avatar_url,
                ],
                "available_tickets" => $ticket->available_tickets,
                "total_tickets" => $ticket->total_tickets,
                "used_tickets" => $ticket->used_tickets,
                "ticket_id" => $ticket->id
            ];
        });

        return response()->json([
            "doctors" => $doctors,
            "date_appointment" => $date_appointment,
            "total_doctors" => $doctors->count()
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
                    "title" => "CITA MEDICA - ".($appointment->doctor->name. ' '.$appointment->doctor->surname)." - ".$appointment->specialitie->name,
                    "start" => Carbon::parse($appointment->date_appointment)->format("Y-m-d H:i:s"),
                    "end" => Carbon::parse($appointment->date_appointment)->addHour()->format("Y-m-d H:i:s"),
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

        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date_appointment' => 'required|date',
            'specialitie_id' => 'required|exists:specialities,id',
        ]);

        return DB::transaction(function () use ($request) {

            $appointmentDate = Carbon::parse($request->date_appointment)->format('Y-m-d');

            try {
                $this->doctorTicketService->validateAppointmentAvailability(
                    $request->doctor_id,
                    $appointmentDate
                );
            } catch (\Exception $e) {
                return response()->json([
                    "message" => 422,
                    "message_text" => $e->getMessage()
                ], 422);
            }

            try {
                $doctorTicket = $this->doctorTicketService->reserveTicket(
                    $request->doctor_id,
                    $appointmentDate
                );
            } catch (\Exception $e) {
                return response()->json([
                    "message" => 422,
                    "message_text" => "Error al reservar el cupo: " . $e->getMessage()
                ], 422);
            }

            $patient = Patient::where("identification_number", $request->identification_number)->first();

            if (!$patient) {
                $patient = Patient::create([
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "first_phone" => $request->first_phone,
                    "identification_number" => $request->identification_number,
                ]);

                PatientPerson::create([
                    "patient_id" => $patient->id,
                    "name_companion" => $request->name_companion ?? null,
                    "surname_companion" => $request->surname_companion ?? null,
                ]);
            } else {
                if ($patient->person) {
                    $patient->person->update([
                        "name_companion" => $request->name_companion ?? null,
                        "surname_companion" => $request->surname_companion ?? null,
                    ]);
                } else {
                    PatientPerson::create([
                        "patient_id" => $patient->id,
                        "name_companion" => $request->name_companion ?? null,
                        "surname_companion" => $request->surname_companion ?? null,
                    ]);
                }
            }

            $appointment = Appointment::create([
                "doctor_id" => $request->doctor_id,
                "patient_id" => $patient->id,
                "date_appointment" => Carbon::parse($request->date_appointment)->format("Y-m-d H:i:s"),
                "specialitie_id" => $request->specialitie_id,
                "doctor_ticket_id" => $doctorTicket->id,
                "user_id" => auth("api")->user()->id,
                "amount" => $request->amount,
                "status_pay" => $request->amount != $request->amount_add ? 2 : 1,
            ]);

            AppointmentPay::create([
                "appointment_id" => $appointment->id,
                "amount" => $request->amount_add,
                "method_payment" => $request->method_payment,
            ]);

            return response()->json([
                "message" => 200,
                "appointment_id" => $appointment->id,
                "remaining_tickets" => $doctorTicket->fresh()->available_tickets
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $appointment = Appointment::findOrFail($id);
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

        return DB::transaction(function () use ($request, $appointment) {

            $oldDoctorId = $appointment->doctor_id;
            $oldDate = Carbon::parse($appointment->date_appointment)->format('Y-m-d');
            $newDoctorId = $request->doctor_id;
            $newDate = Carbon::parse($request->date_appointment)->format('Y-m-d');

            if ($oldDoctorId != $newDoctorId || $oldDate != $newDate) {

                try {
                    $this->doctorTicketService->validateAppointmentAvailability($newDoctorId, $newDate);
                } catch (\Exception $e) {
                    return response()->json([
                        "message" => 422,
                        "message_text" => $e->getMessage()
                    ], 422);
                }

                try {
                    $newDoctorTicket = $this->doctorTicketService->reserveTicket($newDoctorId, $newDate);
                } catch (\Exception $e) {
                    return response()->json([
                        "message" => 422,
                        "message_text" => "Error al reservar el nuevo cupo: " . $e->getMessage()
                    ], 422);
                }

                $this->doctorTicketService->releaseTicket($oldDoctorId, $oldDate);

                $appointment->update([
                    "doctor_id" => $request->doctor_id,
                    "date_appointment" => Carbon::parse($request->date_appointment)->format("Y-m-d H:i:s"),
                    "specialitie_id" => $request->specialitie_id,
                    "doctor_ticket_id" => $newDoctorTicket->id,
                    "amount" => $request->amount,
                    "status_pay" => $appointment->payments->sum("amount") != $request->amount ? 2 : 1,
                ]);

            } else {
                $appointment->update([
                    "doctor_id" => $request->doctor_id,
                    "date_appointment" => Carbon::parse($request->date_appointment)->format("Y-m-d H:i:s"),
                    "specialitie_id" => $request->specialitie_id,
                    "amount" => $request->amount,
                    "status_pay" => $appointment->payments->sum("amount") != $request->amount ? 2 : 1,
                ]);
            }

            return response()->json([
                "message" => 200,
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->authorize('delete',$appointment);

        return DB::transaction(function () use ($appointment) {

            if ($appointment->doctorTicket) {
                $this->doctorTicketService->releaseTicket(
                    $appointment->doctor_id,
                    Carbon::parse($appointment->date_appointment)->format('Y-m-d')
                );
            }

            $appointment->delete();

            return response()->json([
                "message" => 200,
            ]);
        });
    }
}

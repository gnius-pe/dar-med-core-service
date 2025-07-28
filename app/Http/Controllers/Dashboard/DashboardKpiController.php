<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Patient\Patient;
use App\Http\Resources\Appointment\AppointmentResource;

class DashboardKpiController extends Controller
{

    public function config(): JsonResponse
    {
        $users = User::orderBy("id","desc")
            ->whereHas("roles",function($q){
                $q->where("name","like","%DOCTOR%");
            })
            ->get();

        return response()->json([
            "doctors" => $users->map(function($user){
                return [
                    "id" => $user->id,
                    "full_name" => $user->name.' '.$user->surname,
                ];
            }),
        ]);
    }

    public function dashboard_admin(Request $request): JsonResponse
    {
        if(!auth('api')->user()->can('admin_dashboard')){
            return response()->json(["message" => "EL USUARIO NO ESTA AUTORIZADO"],403);
        }

        date_default_timezone_set('America/Lima');
        $now = now();

        // Estadísticas básicas actuales
        $total_appointments = Appointment::whereNull('deleted_at')->count();
        $total_patients = Patient::whereNull('deleted_at')->count();
        $total_doctors = User::whereHas("roles", function($q){
            $q->where("name","like","%DOCTOR%");
        })->count();

        $total_staff = User::whereHas("roles", function($q){
            $q->where("name","not like","%DOCTOR%");
        })->count();

        // Citas de hoy
        $appointments_today = Appointment::whereNull('deleted_at')
            ->whereDate('date_appointment', $now->toDateString())
            ->count();

        // Citas pendientes (status = 1)
        $pending_appointments = Appointment::whereNull('deleted_at')
            ->where('status', 1)
            ->count();

        // Citas atendidas (status = 2)
        $completed_appointments = Appointment::whereNull('deleted_at')
            ->where('status', 2)
            ->count();

        // Últimas citas pendientes para mostrar en tabla
        $recent_appointments = Appointment::with(['doctor', 'patient', 'specialitie'])
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->orderBy('date_appointment', 'asc')
            ->take(10)
            ->get();

        return response()->json([
            "appointments" => [
                "data" => AppointmentResource::collection($recent_appointments)
            ],

            // Estadísticas principales
            "total_appointments" => $total_appointments,
            "total_patients" => $total_patients,
            "total_doctors" => $total_doctors,
            "total_staff" => $total_staff,

            // Estadísticas del día
            "appointments_today" => $appointments_today,
            "pending_appointments" => $pending_appointments,
            "completed_appointments" => $completed_appointments,
        ]);
    }

    public function dashboard_admin_year(Request $request): JsonResponse
    {
        if(!auth('api')->user()->can('admin_dashboard')){
            return response()->json(["message" => "EL USUARIO NO ESTA AUTORIZADO"],403);
        }

        $year = $request->year ?? date('Y');

        // Pacientes por género por mes
        $query_patient_by_genders = [];
        for ($month = 1; $month <= 12; $month++) {
            $hombres = Patient::whereNull('deleted_at')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('gender', 1)
                ->count();

            $mujeres = Patient::whereNull('deleted_at')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('gender', 2)
                ->count();

            $query_patient_by_genders[] = [
                'month' => $month,
                'hombre' => $hombres,
                'mujer' => $mujeres,
            ];
        }

        // Citas por especialidad
        $query_patients_speciality = DB::table("appointments")
            ->whereNull("appointments.deleted_at")
            ->whereYear("appointments.date_appointment", $year)
            ->join("specialities","appointments.specialitie_id", "=", "specialities.id")
            ->select("specialities.name as name", DB::raw("COUNT(appointments.id) as count"))
            ->groupBy("specialities.id", "specialities.name")
            ->orderBy("count", "desc")
            ->get();

        // Calcular porcentajes de especialidades
        $total_appointments_speciality = $query_patients_speciality->sum("count");
        $query_patients_speciality_percentage = collect([]);

        foreach ($query_patients_speciality as $speciality) {
            $percentage = $total_appointments_speciality > 0
                ? round(($speciality->count / $total_appointments_speciality) * 100, 2)
                : 0;

            $query_patients_speciality_percentage->push([
                "name" => $speciality->name,
                "count" => $speciality->count,
                "percentage" => $percentage,
            ]);
        }

        // Citas por mes del año
        $appointments_by_month = [];
        $months_name = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];

        for ($month = 1; $month <= 12; $month++) {
            $count = Appointment::whereNull('deleted_at')
                ->whereYear('date_appointment', $year)
                ->whereMonth('date_appointment', $month)
                ->count();

            $appointments_by_month[] = [
                'month' => $month,
                'month_name' => $months_name[$month - 1],
                'count' => $count,
            ];
        }

        return response()->json([
            "months_name" => $months_name,
            "query_patient_by_genders" => $query_patient_by_genders,
            "query_patients_speciality" => $query_patients_speciality,
            "query_patients_speciality_percentage" => $query_patients_speciality_percentage,
            "appointments_by_month" => $appointments_by_month,
        ]);
    }

    public function dashboard_doctor(Request $request): JsonResponse
    {
        if(!auth('api')->user()->can('doctor_dashboard')){
            return response()->json(["message" => "EL USUARIO NO ESTA AUTORIZADO"],403);
        }

        date_default_timezone_set('America/Lima');
        $doctor_id = $request->doctor_id;
        $now = now();

        // Estadísticas del doctor
        $total_appointments = Appointment::whereNull('deleted_at')
            ->where('doctor_id', $doctor_id)
            ->count();

        $appointments_today = Appointment::whereNull('deleted_at')
            ->where('doctor_id', $doctor_id)
            ->whereDate('date_appointment', $now->toDateString())
            ->count();

        $pending_appointments = Appointment::whereNull('deleted_at')
            ->where('doctor_id', $doctor_id)
            ->where('status', 1)
            ->count();

        $completed_appointments = Appointment::whereNull('deleted_at')
            ->where('doctor_id', $doctor_id)
            ->where('status', 2)
            ->count();

        // Últimas citas del doctor
        $recent_appointments = Appointment::with(['patient', 'specialitie'])
            ->whereNull('deleted_at')
            ->where('doctor_id', $doctor_id)
            ->where('status', 1)
            ->orderBy('date_appointment', 'asc')
            ->take(10)
            ->get();

        return response()->json([
            // SOLUCIÓN: Usar AppointmentResource::collection() en lugar de AppointmentCollection::make()
            "appointments" => [
                "data" => AppointmentResource::collection($recent_appointments)
            ],
            "total_appointments" => $total_appointments,
            "appointments_today" => $appointments_today,
            "pending_appointments" => $pending_appointments,
            "completed_appointments" => $completed_appointments,
        ]);
    }

    public function dashboard_doctor_year(Request $request): JsonResponse
    {
        if(!auth('api')->user()->can('doctor_dashboard')){
            return response()->json(["message" => "EL USUARIO NO ESTA AUTORIZADO"],403);
        }

        $year = $request->year ?? date('Y');
        $doctor_id = $request->doctor_id;

        // Pacientes atendidos por género
        $query_patient_by_genders = DB::table("appointments")
            ->whereNull("appointments.deleted_at")
            ->whereYear("appointments.date_appointment", $year)
            ->where("appointments.doctor_id", $doctor_id)
            ->join("patients","appointments.patient_id", "=", "patients.id")
            ->select(
                DB::raw("SUM(CASE WHEN patients.gender = 1 THEN 1 ELSE 0 END) as hombre"),
                DB::raw("SUM(CASE WHEN patients.gender = 2 THEN 1 ELSE 0 END) as mujer")
            )
            ->first();

        // Citas por mes para el doctor
        $appointments_by_month = [];
        $months_name = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];

        for ($month = 1; $month <= 12; $month++) {
            $count = Appointment::whereNull('deleted_at')
                ->where('doctor_id', $doctor_id)
                ->whereYear('date_appointment', $year)
                ->whereMonth('date_appointment', $month)
                ->count();

            $appointments_by_month[] = [
                'month' => $month,
                'month_name' => $months_name[$month - 1],
                'count' => $count,
            ];
        }

        return response()->json([
            "months_name" => $months_name,
            "query_patient_by_genders" => $query_patient_by_genders,
            "appointments_by_month" => $appointments_by_month,
        ]);
    }
}

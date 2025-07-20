<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Doctor\DoctorTicket;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment\Appointment;

class DoctorTicketService
{
    /**
     * Obtener doctores disponibles para una fecha específica
     */
    public function getAvailableDoctors($date, $specialitiesId = null)
    {
        $query = DoctorTicket::with(['doctor.specialitie'])
            ->active()
            ->available()
            ->forDate($date);

        if ($specialitiesId) {
            $query->whereHas('doctor', function ($q) use ($specialitiesId) {
                $q->where('specialitie_id', $specialitiesId);
            });
        }

        return $query->get();
    }

    /**
     * Verificar si un doctor tiene cupos disponibles para una fecha
     */
    public function hasAvailableTickets($doctorId, $date): bool
    {
        $ticket = DoctorTicket::forDoctor($doctorId)
            ->forDate($date)
            ->active()
            ->first();

        return $ticket && $ticket->hasAvailableTickets();
    }

    /**
     * Reservar un ticket para una cita
     */
    public function reserveTicket($doctorId, $date)
    {
        return DB::transaction(function () use ($doctorId, $date) {
            $ticket = DoctorTicket::forDoctor($doctorId)
                ->forDate($date)
                ->active()
                ->lockForUpdate()
                ->first();

            if (!$ticket) {
                throw new \Exception('No se encontraron tickets para este doctor en la fecha especificada');
            }

            if (!$ticket->hasAvailableTickets()) {
                throw new \Exception('No hay cupos disponibles para esta fecha');
            }

            $ticket->reserveTicket();
            return $ticket;
        });
    }

    /**
     * Liberar un ticket (cuando se cancela una cita)
     */
    public function releaseTicket($doctorId, $date)
    {
        return DB::transaction(function () use ($doctorId, $date) {
            $ticket = DoctorTicket::forDoctor($doctorId)
                ->forDate($date)
                ->lockForUpdate()
                ->first();

            if ($ticket) {
                $ticket->releaseTicket();
                return $ticket;
            }

            return null;
        });
    }

    /**
     * Crear o actualizar tickets para un doctor
     */
    public function createOrUpdateTickets($doctorId, $date, $totalTickets)
    {
        return DoctorTicket::updateOrCreate(
            [
                'doctor_id' => $doctorId,
                'available_date' => Carbon::parse($date)->format('Y-m-d')
            ],
            [
                'total_tickets' => $totalTickets,
                'is_active' => true
            ]
        );
    }

    /**
     * Obtener estadísticas de tickets para un doctor
     */
    public function getDoctorTicketStats($doctorId, $startDate = null, $endDate = null)
    {
        $query = DoctorTicket::forDoctor($doctorId);

        if ($startDate) {
            $query->whereDate('available_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('available_date', '<=', $endDate);
        }

        $tickets = $query->get();

        return [
            'total_tickets' => $tickets->sum('total_tickets'),
            'used_tickets' => $tickets->sum('used_tickets'),
            'available_tickets' => $tickets->sum('available_tickets'),
            'utilization_percentage' => $tickets->avg('utilization_percentage'),
            'active_dates' => $tickets->where('is_active', true)->count()
        ];
    }

    /**
     * Validar disponibilidad antes de crear cita
     */
    public function validateAppointmentAvailability($doctorId, $date): bool
    {
        if (!$this->hasAvailableTickets($doctorId, $date)) {
            throw new \Exception('No hay cupos disponibles para el doctor seleccionado en la fecha especificada');
        }

        return true;
    }

    /**
     * Sincronizar tickets usados con citas existentes (útil para migración)
     */
    public function syncUsedTickets($doctorId, $date)
    {
        $ticket = DoctorTicket::forDoctor($doctorId)->forDate($date)->first();

        if ($ticket) {
            $appointmentsCount = Appointment::where('doctor_id', $doctorId)
                ->whereDate('date_appointment', $date)
                ->count();

            $ticket->update(['used_tickets' => $appointmentsCount]);
        }

        return $ticket;
    }
}

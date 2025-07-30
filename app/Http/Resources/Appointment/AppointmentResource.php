<?php

namespace App\Http\Resources\Appointment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'doctor' => $this->doctor ? [
                'id' => $this->doctor->id,
                'full_name' => $this->doctor->name . ' ' . ($this->doctor->surname ?? ''),
                'name' => $this->doctor->name,
                'surname' => $this->doctor->surname,
                'avatar_url' => $this->doctor->avatar ? env("APP_URL") . "storage/" . $this->doctor->avatar : null,
            ] : [
                'id' => null,
                'full_name' => 'Doctor no disponible',
                'name' => 'No disponible',
                'surname' => '',
                'avatar_url' => null,
            ],
            'patient' => $this->patient ? [
                'id' => $this->patient->id,
                'full_name' => $this->patient->first_name . ' ' . ($this->patient->last_name ?? ''),
                'first_name' => $this->patient->first_name,
                'last_name' => $this->patient->last_name,
                'identification_number' => $this->patient->identification_number,
                'first_phone' => $this->patient->first_phone,
            ] : [
                'id' => null,
                'full_name' => 'Paciente no disponible',
                'first_name' => 'No disponible',
                'last_name' => '',
                'identification_number' => '',
                'first_phone' => '',
            ],
            'specialitie' => $this->specialitie ? [
                'id' => $this->specialitie->id,
                'name' => $this->specialitie->name,
            ] : [
                'id' => null,
                'name' => 'Sin especialidad',
            ],
            'date_appointment' => $this->date_appointment,
            'date_appointment_format' => Carbon::parse($this->date_appointment)->format('d M Y'),
            'time_appointment' => Carbon::parse($this->date_appointment)->format('h:i A'),
            'date_time_formatted' => Carbon::parse($this->date_appointment)->format('d/m/Y h:i A'),
            'status' => $this->status,
            'status_pay' => $this->status_pay,
            'status_text' => $this->status === 1 ? 'PENDIENTE' : 'ATENDIDO',
            'amount' => $this->amount,
            'doctor_ticket' => $this->doctorTicket ? [
                'id' => $this->doctorTicket->id,
                'available_tickets' => $this->doctorTicket->available_tickets,
                'total_tickets' => $this->doctorTicket->total_tickets,
            ] : null,
            'created_at' => Carbon::parse($this->created_at)->format('d M Y'),
            'created_at_full' => Carbon::parse($this->created_at)->format('d/m/Y h:i A'),
        ];
    }
}

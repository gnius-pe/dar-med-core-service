<?php

namespace App\Http\Resources\Appointment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "doctor_id" => $this->resource->doctor_id,
            "doctor" => $this->resource->doctor ? [
                "id" => $this->resource->doctor->id,
                "full_name" => $this->resource->doctor->name. ' '.$this->resource->doctor->surname
            ] : NULL,
            "patient_id" => $this->resource->patient_id,
            "patient" =>  $this->resource->patient ? 
                [
                    
                    "first_phone" => $request->first_phone,
                    "identification_number" => $request->identification_number,
                    "first_name" => $this->resource->patient->first_name,
                    "last_name" => $this->resource->patient->last_name,
                    "full_name" => $this->resource->patient->first_name. ' '.$this->resource->patient->last_name,
                    "first_phone" => $this->resource->patient->first_phone,
                    "identification_number" => $this->resource->patient->identification_number,
                    "name_companion" => $this->resource->patient->person->name_companion?? null,
                    "surname_companion" => $this->resource->patient->person->surname_companion?? null,
                ] : NULL,
            "date_appointment" => $this->resource->date_appointment,
            "date_appointment_format" => Carbon::parse($this->resource->date_appointment)->format("Y-m-d"),
            "specialitie_id" => $this->resource->specialitie_id,
            "specialitie" => $this->resource->specialitie ? [
                "id" => $this->resource->specialitie->id,
                "name" => $this->resource->specialitie->name,
            ] : NULL,
            
            "doctor_schedule_join_hour_id" => $this->resource->doctor_schedule_join_hour_id,
            "segment_hour" => $this->resource->doctor_schedule_join_hour ? [
                "id" => $this->resource->doctor_schedule_join_hour->id,
                "doctor_schedule_day_id" => $this->resource->doctor_schedule_join_hour->doctor_schedule_day_id,
                "doctor_schedule_hour_id" => $this->resource->doctor_schedule_join_hour->doctor_schedule_hour_id,
                // "is_appoinment" => $appointment ? true : false,
                "format_segment" => [
                    "id" => $this->resource->doctor_schedule_join_hour->doctor_schedule_hour->id,
                    "hour_start" => $this->resource->doctor_schedule_join_hour->doctor_schedule_hour->hour_start,
                    "hour_end" => $this->resource->doctor_schedule_join_hour->doctor_schedule_hour->hour_end,
                    "format_hour_start" => Carbon::parse(date("Y-m-d").' '.$this->resource->doctor_schedule_join_hour->doctor_schedule_hour->hour_start)->format("h:i A"),
                    "format_hour_end" => Carbon::parse(date("Y-m-d").' '.$this->resource->doctor_schedule_join_hour->doctor_schedule_hour->hour_end)->format("h:i A"),
                    "hour" => $this->resource->doctor_schedule_join_hour->doctor_schedule_hour->hour,
                ]
            ]: NULL,
            "user_id" => $this->resource->user_id,
            "user" => $this->resource->user ? [
                "id" => $this->resource->doctor->id,
                "full_name" => $this->resource->doctor->name. ' '.$this->resource->doctor->surname
            ]: NULL,
            "amount" => $this->resource->amount,
            "status_pay" => $this->resource->status_pay,
            "status" => $this->resource->status,
            "created_at" => $this->resource->created_at->format("Y-m-d h:i A"),
        ];
    }
}

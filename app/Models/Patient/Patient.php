<?php

namespace App\Models\Patient;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'identification_type',
        'identification_number',
        'first_name',
        'last_name',
        'email',
        'birth_date',
        'first_phone',
        'second_phone',
        'gender',
        'message',
        'medical_examination',
        'spiritual_support',
        'permission_to_call',
        'visit_condition',
        'spiritual_diagnosis',
    ];

    public function setCreatedAtAttribute($value)
    {
    	date_default_timezone_set('America/Lima');
        $this->attributes["created_at"]= Carbon::now();
    }

    public function setUpdatedAtAttribute($value)
    {
    	date_default_timezone_set("America/Lima");
        $this->attributes["updated_at"]= Carbon::now();
    }

/*    public function person() {
        return $this->hasOne(PatientPerson::class,"patient_id");
    }*/
}

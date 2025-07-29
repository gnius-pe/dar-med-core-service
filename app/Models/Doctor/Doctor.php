<?php

namespace App\Models\Doctor;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'mobile',
        'birth_date',
        'gender',
        'education',
        'designation',
        'address',
        'specialitie_id',
        'state'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        'password' => 'hashed',
    ];

    public function setCreatedAtAttribute($value): void
    {
        date_default_timezone_set('America/Lima');
        $this->attributes["created_at"] = Carbon::now();
    }

    public function setUpdatedAtAttribute($value): void
    {
        date_default_timezone_set("America/Lima");
        $this->attributes["updated_at"] = Carbon::now();
    }

    // Global scope para solo obtener doctores (usuarios con specialitie_id)
    protected static function booted(): void
    {
        static::addGlobalScope('doctors', function ($builder) {
            $builder->whereNotNull('specialitie_id');
        });
    }

    // Relación con especialidad
    public function specialitie(): BelongsTo
    {
        return $this->belongsTo(Specialitie::class);
    }

    // Relación con citas
    public function appointments(): HasMany
    {
        return $this->hasMany(\App\Models\Appointment\Appointment::class, 'doctor_id');
    }

    // Relación con roles (hereda de User)
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(\Spatie\Permission\Models\Role::class, 'model_has_roles', 'model_id', 'role_id')
            ->where('model_type', User::class);
    }
}

<?php

namespace App\Models\Doctor;

use App\Models\Appointment\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'available_date',
        'total_tickets',
        'used_tickets',
        'is_active'
    ];

    protected $casts = [
        'available_date' => 'date',
        'is_active' => 'boolean'
    ];

    protected $appends = ['available_tickets'];

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

    // Relaciones
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'doctor_ticket_id');
    }

    // Accessors
    public function getAvailableTicketsAttribute()
    {
        return $this->total_tickets - $this->used_tickets;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query)
    {
        return $query->whereRaw('total_tickets > used_tickets');
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('available_date', $date);
    }

    public function scopeForDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    // Métodos de negocio
    public function hasAvailableTickets(): bool
    {
        return $this->available_tickets > 0 && $this->is_active;
    }

    public function reserveTicket(): static
    {
        if (!$this->hasAvailableTickets()) {
            throw new \Exception('No hay tickets disponibles para esta fecha');
        }

        $this->increment('used_tickets');
        return $this;
    }

    public function releaseTicket(): static
    {
        if ($this->used_tickets > 0) {
            $this->decrement('used_tickets');
        }
        return $this;
    }

    public function getUtilizationPercentageAttribute(): float|int
    {
        if ($this->total_tickets == 0) return 0;
        return round(($this->used_tickets / $this->total_tickets) * 100, 2);
    }
}

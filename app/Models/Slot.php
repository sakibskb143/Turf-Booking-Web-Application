<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'turf_id',
        'date',
        'start_time',
        'end_time',
        'price',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getStartTimeFormattedAttribute(): string
    {
        return is_string($this->start_time) ? $this->start_time : date('H:i', strtotime($this->start_time));
    }

    public function getEndTimeFormattedAttribute(): string
    {
        return is_string($this->end_time) ? $this->end_time : date('H:i', strtotime($this->end_time));
    }

    public function turf(): BelongsTo
    {
        return $this->belongsTo(Turf::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function isAvailable(): bool
    {
        if ($this->status !== 'available') {
            return false;
        }

        return !$this->bookings()
            ->where('status', '!=', 'cancelled')
            ->exists();
    }
}


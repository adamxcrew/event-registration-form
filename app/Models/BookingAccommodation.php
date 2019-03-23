<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAccommodation extends Model
{
    protected $fillable = [
        'registration_id', 'accommodation_id', 'check_in', 'check_out', 'duration', 'fee'
    ];

    public function getFeeAttribute($value) {
        return number_format($value,0,',','.');
    }

    public function setFeeAttribute($value) {
        $this->attributes['fee'] = str_replace('.', '', $value);
    }

    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function accommodation() {
        return $this->belongsTo(Accommodation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAccommodation extends Model
{
    protected $fillable = [
        'registration_id', 'room_type_id', 'check_in', 'check_out', 'duration', 'fee'
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

    public function roomType() {
        return $this->belongsTo(RoomType::class);
    }
}

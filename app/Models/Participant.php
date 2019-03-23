<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Participant extends Model
{
    protected $fillable = [
        'name', 'birth_place', 'birth_date', 'gender', 'address', 'phone', 'profession', 'company', 'information', 'user_id'
    ];
    protected $dates = ['birth_date'];
    protected $appends = ['birth'];

    public function getBirthAttribute() {
        $place = $this->birth_place;
        $date = $this->birth_date ? $this->birth_date->format('d/m/Y') : NULL;

        if ($place && $date) {
            return $place . ', ' . $date;
        }

        return null;
    }

    public function setBirthDateAttribute($value) {
        $this->attributes['birth_date'] = Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d');
    }

    public function gender() {
        if ($this->gender == 'P') {
            return 'Perempuan';
        }
        return 'Laki-laki';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

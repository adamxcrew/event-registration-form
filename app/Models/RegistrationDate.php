<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class RegistrationDate extends Model
{
    protected $table = 'registration_date';
    protected $dates = ['early_bird', 'normal'];

    public function isEarlyBird() {
        return Carbon::now() < $this->normal;
    }
}

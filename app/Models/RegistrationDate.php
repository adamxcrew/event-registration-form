<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationDate extends Model
{
    protected $table = 'registration_date';
    protected $dates = ['early_bird', 'normal'];

    public function isEarlyBird() {
        return now() >= $this->early && now() < $this->normal;
    }
}

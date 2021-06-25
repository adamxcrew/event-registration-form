<?php

namespace App\Traits;

use App\Models\Registration;

/**
 * Priceable relationship trait
 */
trait HasRegistration
{
    public function registration()
    {
        return $this->morphOne(Registration::class, 'registerable');
    }


    public function registrations()
    {
        return $this->morphMany(Registration::class, 'registerable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationFee extends Model
{
    protected $table = 'registration_fee';
    protected $appends = ['fee', 'formated_fee'];

    public function getFeeAttribute() {
        $registration = RegistrationDate::all()->first();
        if ($registration->isEarlyBird()) {
            $fee = $this->early_fee;
        } else {
            $fee = $this->normal_fee;
        }
        return $fee;
    }

    public function package() {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function category() {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }
}

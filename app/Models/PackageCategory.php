<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    public function fee() {
        return $this->hasMany(RegistrationFee::class, 'package_id');
    }
}

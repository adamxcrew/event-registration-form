<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function fee() {
        return $this->hasMany(RegistrationFee::class, 'package_id');
    }
}

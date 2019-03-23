<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    public function fee() {
        return $this->hasMany(RegistrationFee::class, 'package_id');
    }
}

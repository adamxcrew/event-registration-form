<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasPrice;

    protected $fillable = ['name', 'description'];

    public function fee() {
        return $this->hasMany(RegistrationFee::class, 'package_id');
    }
}

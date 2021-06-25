<?php

namespace App\Models;

use App\Traits\HasPrice;
use App\Traits\HasRegistration;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasPrice, HasRegistration;

    protected $fillable = ['name', 'description', 'min', 'max'];
}

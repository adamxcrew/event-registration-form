<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];
}

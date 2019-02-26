<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];
    protected $dates = ['deleted_at'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}

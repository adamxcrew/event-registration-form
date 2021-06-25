<?php

namespace App\Models;

use App\Traits\HasPrice;
use App\Traits\HasRegistration;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasPrice, HasRegistration;

    protected $fillable = ['name', 'description', 'additional_information', 'category', 'time'];

    public function levels() {
        return $this->belongsToMany(Level::class, 'event_level', 'event_id', 'level_id');
    }
}

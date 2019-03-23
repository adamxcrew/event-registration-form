<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function events() {
        return $this->belongsToMany(Event::class, 'event_level', 'level_id', 'event_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $fillable = ['hotel', 'rate', 'address'];
    public $timestamps = false;

    public function types() {
        return $this->hasMany(RoomType::class, 'room_type_id');
    }
}

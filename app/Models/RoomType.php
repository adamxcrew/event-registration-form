<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = ['accommodation_id', 'type', 'price'];
    public $timestamps = false;

    public function getPriceAttribute($value) {
        return number_format($value,0,',','.');
    }

    public function setPriceAttribute($value) {
        $this->attributes['price'] = str_replace('.', '', $value);
    }

    public function accommodation() {
        return $this->belongsTo(Accommodation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $fillable = ['hotel', 'rate', 'price'];
    public $timestamps = false;

    public function getPriceAttribute($value) {
        return number_format($value,0,',','.');
    }

    public function setPriceAttribute($value) {
        $this->attributes['price'] = str_replace('.', '', $value);
    }
}

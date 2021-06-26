<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    protected $fillable = ['key', 'value'];
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    public function isEarly()
    {
        $early = $this->key('early');
        $normal = $this->key('normal');
        return isset($early) && now() >= $early && now() < $normal;
    }

    public function key($key)
    {
        $value = optional($this->where('key', $key)->first())->value;
        if (strtotime($value)) {
            return Carbon::createFromFormat('Y-m-d', $value);
        } else {
            return $value;
        }
    }
}

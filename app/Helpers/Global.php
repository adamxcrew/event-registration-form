<?php

use App\Models\Config;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

function wrap($value)
{
    return Arr::wrap($value);
}

function IDR($value)
{
    return 'Rp. ' . number($value);
}

function number($value)
{
    if ($value && is_numeric($value)) {
        return number_format($value, 0, ',', '.');
    }
    return $value;
}

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function eventInfo($key = null){
    $config = new Config;

    return is_null($key)
            ? $config
            : $config->key($key);
}
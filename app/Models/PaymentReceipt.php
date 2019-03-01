<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PaymentReceipt extends Model
{
    protected $fillable = ['registration_id', 'name', 'bank', 'account', 'nominal', 'paid_at', 'file'];
    protected $dates = ['paid_at'];

    public function setPaidAtAttribute($value) {
        $this->attributes['paid_at'] = Carbon::createFromFormat("d/m/Y", $value)->format('Y-m-d');
    }
}

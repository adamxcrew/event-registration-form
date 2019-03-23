<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PaymentReceipt extends Model
{
    protected $fillable = ['registration_id', 'name', 'bank', 'account', 'nominal', 'paid_at', 'file'];
    protected $dates = ['paid_at'];

    public function fileInfo() {
        return pathinfo(asset($this->file));
    }
}

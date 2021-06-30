<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PaymentReceipt extends Model
{
    protected $fillable = ['registration_id', 'name', 'bank', 'account', 'nominal', 'paid_at', 'file'];
    protected $dates = ['paid_at'];
    protected $appends = ['file_url', 'file_info'];

    public function getFileUrlAttribute()
    {
        return Storage::disk('public')->url($this->file);
    }

    public function getFileInfoAttribute()
    {
        return pathinfo($this->file_url);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}

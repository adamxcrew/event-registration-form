<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $fillable = ['code', 'user_id', 'package_id', 'category_id', 'paybill', 'status'];
    protected $appends = ['is_paid'];

    public function getIsPaidAttribute() {
        return $this->has('receipt');
    }

    public function getPaybillAttribute($value) {
        return number_format($value,0,',','.');
    }

    public function setPaybillAttribute($value) {
        $this->attributes['paybill'] = str_replace('.', '', $value);
    }

    public function status() {
        $status = $this->attributes['status'];
        switch ($status) {
            case 1:
                $label = '<span class="badge badge-warning">Menunggu Verifikasi</span>';
                break;
            case 2:
                $label = '<span class="badge badge-success">LUNAS</span>';
                break;
            default:
                $label = '<span class="badge badge-secondary">Belum membayar</span>';
                break;
        }
        return $label;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }

    public function category() {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }

    public function receipt() {
        return $this->hasOne(PaymentReceipt::class, 'registration_id');
    }

    public function booking() {
        return $this->hasOne(BookingAccommodation::class);
    }

    public function events() {
        return $this->belongsToMany(Event::class, 'registration_event', 'registration_id', 'event_id');
    }

    public static function boot() {
        parent::boot();
        static::created(function ($model) {
            $id = $model->id;
            $prefix = strtoupper(substr($model->user->name, 0, 1));
            switch (strlen($id)) {
                case 1:
                    $code = '000' . $id;
                    break;
                case 2:
                    $code = '00' . $id;
                    break;
                case 3:
                    $code = '0' . $id;
                    break;
                default:
                    $code = $id;
                    break;
            }
            $model->code = $prefix . Carbon::now()->format('Ymj') . $code;
            $model->save();
        });
    }
}

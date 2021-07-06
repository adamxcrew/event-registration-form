<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Orderable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    use Searchable, Orderable, Filterable;

    protected $table = 'registrations';
    protected $fillable = ['code', 'user_id', 'category_id', 'level_id', 'paybill', 'status'];
    protected $appends = ['is_paid'];
    protected $filterable = ['status'];
    protected $orderable = ['code', 'created_at'];
    protected $searchable = ['code', 'participant' => 'name'];

    public function getIsPaidAttribute() {
        return $this->has('receipt');
    }

    public function getExpiredAttribute() {
        $date = RegistrationDate::all()->first();
        return now() >= $date->normal && $this->updated_at < $date->normal && $this->status == 0;
    }

    public function status() {
        return [
            '<span class="badge badge-secondary">Unpaid</span>',
            '<span class="badge badge-warning">Verifying</span>',
            '<span class="badge badge-success">
                <svg class="icon mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Paid
            </span>',
        ][$this->status - 1];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function participant() {
        return $this->belongsTo(Participant::class, 'user_id', 'user_id');
    }

    public function package() {
        return $this->belongsTo($this->registerable_type, 'registerable_id');
    }

    public function event() {
        return $this->belongsTo($this->registerable_type, 'registerable_id');
    }

    public function category() {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

    public function receipt() {
        return $this->hasOne(PaymentReceipt::class, 'registration_id');
    }

    public function events() {
        return $this->belongsToMany(Event::class, 'registration_event', 'registration_id', 'event_id');
    }

    public static function boot() {
        parent::boot();
        static::created(function ($model) {
            $prefix = strtoupper(substr($model->user->name, 0, 1));
            $model->code = $prefix . now()->format('Ymj') . Str::padLeft($model->id, 3, 0);
            $model->save();
        });
    }
}

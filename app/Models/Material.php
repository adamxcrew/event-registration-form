<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedBy;
use Auth;

class Material extends Model
{
    use CreatedBy;

    protected $fillable = ['name', 'description', 'path', 'downloaded'];

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function download() {
        if (Auth::user()->hasRole('participant')) {
            $this->downloaded = $this->downloaded + 1;
            $this->save();
        }
        return asset($this->path);
    }
}

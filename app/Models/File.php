<?php

namespace App\Models;

use App\Traits\Orderable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use Searchable, Orderable;

    protected $fillable = ['name', 'description', 'path', 'downloaded'];
    protected $searchable = ['name'];
    protected $orderable = ['name'];

    public function download() {
        if (auth()->user()->hasRole('participant')) {
            $this->downloaded = $this->downloaded + 1;
            $this->save();
        }

        return Storage::disk('public')->url($this->path);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleted(function ($file) {
            Storage::disk('public')->delete($file->path);
        });
    }
}

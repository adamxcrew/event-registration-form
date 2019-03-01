<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'username', 'email', 'password', 'last_login_ip', 'last_login_at'];
    protected $hidden = ['password', 'remember_token'];

    public function participant() {
        return $this->hasOne(Participant::class);
    }

    public function registration() {
        return $this->hasOne(Registration::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function role() {
        return $this->roles->first();
    }

    public function assignRole($role) {
        if (is_string($role)) {
            $role = Role::whereName($role)->first();
        }
        return $this->roles()->attach($role);
    }

    public function revokeRole($role) {
        if (is_string($role)) {
            $role = Role::whereName($role)->first();
        }
        return $this->roles()->detach($role);
    }

    public function syncRole($role) {
        if (is_string($role)) {
            $role = Role::whereName($role)->first();
        }
        return $this->roles()->sync($role);
    }

    public function hasRole($roles) {
        if (is_string($roles)) {
            $roles = [$roles];
        }
        foreach ($roles as $name) {
            foreach ($this->roles as $role) {
                if ($role->name === $name) return true;
            }
        }
        return false;
    }
}

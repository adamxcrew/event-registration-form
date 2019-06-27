<?php

use Illuminate\Foundation\Inspiring;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestSendingMail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('password:reset', function () {
    $admin = User::whereHas('roles', function ($query) {
        $query->where('name', 'admin');
    })->first();
    $admin->update([
        'username' => 'pitthorax',
        'password' => bcrypt('tidakpakepassword')
    ]);
    $this->comment('Password reseted.');
});

Artisan::command('testmail', function () {
    $user = User::where('email', 'caesaralilamondo@gmail.com')->first();
    Mail::to($user)->send(new TestSendingMail($user));
    $this->info('Email Sended.');
});
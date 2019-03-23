<?php

use App\Models\User;
use App\Models\Registration;

// Route::get('/render-email', function() {
//     $user = User::find(8);
//     $password = 'password';
//     $markdown = new \Illuminate\Mail\Markdown(view(), config('mail.markdown'));
//     return $markdown->render('mails.registered', [
//         'name' => $user->name,
//         'username' => $user->username,
//         'password' => $password,
//         'registration' => $user->registration,
//         'booking' => $user->registration->accommodation
//     ]);
// });

Route::get('/ticket', function() {
    $code = request()->c;
    $registration = Registration::where('code', $code)->first();
    if ($registration) {
        return view('reports.ticket', compact('registration'));
    }
    abort(404);
});

// Route::get('/ticket2', function() {
//     $user = User::findOrFail(8);
//     $registration = $user->registration;
//     $pdf = PDF::loadView('reports.ticket2', compact('registration'));
//     return $pdf->stream();
//     // return view('reports.ticket2', compact('registration'));
// });

Route::get('/workshops', 'AjaxController@workshop');
Route::get('/room-types', 'AjaxController@roomTypes');

Route::namespace('Auth')->group(function () {
    Route::get('/', 'RegisterController@showRegistrationForm')->middleware('guest')->name('register');
    Route::get('/register', 'RegisterController@showRegistrationForm')->middleware('guest')->name('register');
    Route::get('/accommodation', 'RegisterController@showAccommodationForm')->middleware('guest')->name('accommodation');
    Route::post('/register', 'RegisterController@register')->middleware('guest');
    Route::post('/register/final', 'RegisterController@registerFinal')->middleware('guest');
    Route::get('/login', 'LoginController@showLoginForm')->middleware('guest')->name('login');
    Route::post('/login', 'LoginController@login')->middleware('guest');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::namespace('Admin')->middleware('role:admin|superadmin')->group(function () {
        Route::get('/participants', 'ParticipantController@index')->name('participants.index');
        Route::get('/participants/{participant}/show', 'ParticipantController@show')->name('participants.show');
        Route::patch('/participants/{participant}', 'ParticipantController@update')->name('participants.update');
        Route::delete('/participants/{participant}', 'ParticipantController@destroy')->name('participants.destroy');
        Route::get('/user/{user}/bill', 'BillController@show')->name('bill');
        Route::patch('/user/{user}/bill', 'BillController@verified')->name('bill.verified');
    });

    Route::namespace('User')->middleware('role:participant')->group(function () {
        Route::get('/my-ticket', 'PaymentController@ticket')->name('my.ticket');
        Route::post('/upload-payment-receipt', 'PaymentController@pay')->name('payment.receipt');
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::patch('/profile', 'ProfileController@update')->name('profile.update');
    });

    Route::resource('modules', 'ModuleController');
});

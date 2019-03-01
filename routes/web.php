<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect('/register');
// });

// Route::get('/thanks', function () {
//     return view('auth.verify');
// });

// Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('/', 'RegisterController@showRegistrationForm')->middleware('guest')->name('register');
    Route::get('/register', 'RegisterController@showRegistrationForm')->middleware('guest')->name('register');
    Route::post('/register', 'RegisterController@register')->middleware('guest');
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
        Route::get('/user/{user}/bill', 'BillController@show')->name('bill');
        Route::patch('/user/{user}/bill', 'BillController@verified')->name('bill.verified');
    });

    Route::namespace('User')->middleware('role:participant')->group(function () {
        Route::post('/upload-payment-receipt', 'PaymentController@pay')->name('payment.receipt');
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::patch('/profile', 'ProfileController@update')->name('profile.update');
    });

    Route::resource('modules', 'ModuleController');
});

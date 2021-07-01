<?php

Route::namespace('Auth')->group(function () {
    Route::get('/', 'RegisterController@showRegistrationForm')->middleware('guest')->name('register');
    Route::get('/register', 'RegisterController@showRegistrationForm')->middleware('guest')->name('register');
    Route::post('/register', 'RegisterController@register')->middleware('guest');
    Route::get('/login', 'LoginController@showLoginForm')->middleware('guest')->name('login');
    Route::post('/login', 'LoginController@login')->middleware('guest');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::get('/invoice', 'InvoiceController@index');
Route::get('/workshops', 'AjaxController@workshop');
Route::get('/room-types', 'AjaxController@roomTypes');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::namespace('Admin')->middleware('role:admin|superadmin')->group(function () {
        Route::resource('participants', 'ParticipantController')->except('create', 'store', 'edit');

        ROute::get('/participants/{participant}/resend', 'ParticipantController@resendPaybill')->name('participant.resend');
        Route::post('/registrations/export', 'ParticipantController@export')->name('registrations.export');

        Route::get('/user/{id}/bill', 'BillController@show')->name('bill');
        Route::patch('/user/{id}/bill', 'BillController@verified')->name('bill.verified');

        Route::resource('files', 'FileController')->only('index', 'store', 'destroy');
        Route::resource('category', 'CategoryController')->except('show');
        Route::resource('event', 'EventController')->except('show');
        Route::resource('package', 'PackageController')->except('show');
        Route::resource('config', 'ConfigController')->only('index', 'store');
        Route::resource('account', 'AccountController')->only('index', 'store');
    });

    Route::namespace('User')->middleware('role:participant')->group(function () {
        Route::get('/my-ticket', 'PaymentController@ticket')->name('my.ticket');
        Route::post('/upload-payment-receipt', 'PaymentController@pay')->name('payment.receipt');
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::patch('/profile', 'ProfileController@update')->name('profile.update');
    });
});

<?php

Auth::routes(['reset' => false, 'confirm' => false]);

Route::get('/', 'Auth\RegisterController@showRegistrationForm')->middleware('guest');

Route::view('/confirm', 'confirm');
Route::post('/confirm', 'PaymentController@confirm')->name('confirm');
Route::get('/invoice', 'InvoiceController');

Route::get('/workshops', 'AjaxController@workshop');
Route::get('/room-types', 'AjaxController@roomTypes');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::namespace('Admin')->middleware('role:admin|superadmin')->group(function () {
        Route::resource('participants', 'ParticipantController')->except('create', 'store', 'edit');
        ROute::get('/participants/{participant}/resend', 'ParticipantController@resendPaybill')->name('participant.resend');
        Route::post('/participants/export', 'ParticipantController@export')->name('participants.export');

        Route::get('registration/{registration}', 'RegistrationController@show')->name('registration.show');
        Route::post('registration/{registration}', 'RegistrationController@verify')->name('registration.verify');

        Route::resource('files', 'FileController')->only('index', 'store', 'destroy');
        Route::resource('category', 'CategoryController')->except('show');
        Route::resource('event', 'EventController')->except('show');
        Route::resource('package', 'PackageController')->except('show');
        Route::resource('config', 'ConfigController')->only('index', 'store');
        Route::resource('account', 'AccountController')->only('index', 'store');

        Route::post('site', 'SiteController@store')->name('site.store');
    });

    Route::middleware('role:participant')->group(function () {
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::patch('/profile', 'ProfileController@update')->name('profile.update');
    });
});

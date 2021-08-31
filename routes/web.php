<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::namespace('Auth')->group(function(){
        Route::get('/register','RegisterController@showRegisterForm')->name('register');
        Route::post('/register','RegisterController@register')->name('register.submit');

        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('login.submit');
        Route::post('/logout','LoginController@logout')->name('logout');
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });
    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::put('/profile', 'AdminController@updateProfile')->name('profile.update');
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('admins', 'AdminsController');

    Route::post('user/{id}/ban', 'UserController@ban')->name('user.ban');
    Route::post('user/{id}/activate', 'UserController@activate')->name('user.activate');
    //countries
    Route::post('country/{id}/ban', 'CountryController@ban')->name('country.ban');
    Route::post('country/{id}/activate', 'CountryController@activate')->name('country.activate');
    Route::resource('country','CountryController');
    //academy sizes
    Route::post('academy_size/{id}/ban', 'AcademySizeController@ban')->name('academy_size.ban');
    Route::post('academy_size/{id}/activate', 'AcademySizeController@activate')->name('academy_size.activate');
    Route::resource('academy_size','AcademySizeController');
    //ads
    Route::post('ad/{id}/ban', 'AdController@ban')->name('ad.ban');
    Route::post('ad/{id}/activate', 'AdController@activate')->name('ad.activate');
    Route::resource('ad','AdController');
    //sports
    Route::post('sport/{id}/ban', 'SportController@ban')->name('sport.ban');
    Route::post('sport/{id}/activate', 'SportController@activate')->name('sport.activate');
    Route::resource('sport','SportController');
    //academies
    Route::resource('academy','AcademyController');
    Route::get('academy-waiting','AcademyController@waiting')->name('academy.waiting');
    Route::get('academy-approved/{id}','UserController@toggle_approved')->name('academy.approved');
    //coaches
    Route::resource('coach','CoachController');
    //players
    Route::resource('player','PlayerController');
    //groups
    Route::resource('group','GroupController');
    //courses
    Route::resource('course','CourseController');

    //players-invoices
    Route::get('invoice/{id}','PlayerInvoiceController@invoice')->name('player.invoice');
    Route::get('player-invoice/{id}/credit-details','PlayerInvoiceController@creditDetails')->name('player-invoice.credit-details');
    Route::post('player-invoice/{id}/invoicing','PlayerInvoiceController@invoicing')->name('player-invoice.invoicing');
    Route::resource('player-invoice','PlayerInvoiceController');

});

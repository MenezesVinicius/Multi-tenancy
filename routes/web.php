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

// Match my own domain
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Route::group(['domain' => 'laravel.test'], function()
//{
//    Route::any('/', function()
//    {
//        return 'My own domain';
//    });
//});
//
//Route::group(['domain' => '{subdomain}.laravel.test'], function()
//{
//    Route::any('/', function($subdomain)
//    {
//        return 'Subdomain ' . $subdomain;
//    });
//});

Route::domain('laravel.test')->group(function () {

    // Landing Page Routes
    Route::get('/', function () {
        return view('welcome');
    });

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Catch All Route
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
// Authentication Web Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

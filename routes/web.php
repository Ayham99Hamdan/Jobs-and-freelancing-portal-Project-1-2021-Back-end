<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => LaravelLocalization::setLocale() ,
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    Route::namespace('Dashboard')->middleware(['locale' , 'auth:admin'])->prefix('Dashboard')->group(function () {
        Route::get('' , 'DashboardController@index')->name('dashboard');

        // Qualification  Routes
        Route::get('qualifications' , 'QualificationController@index')->name('qualification.index');

    });

    // Login Routes
    Auth::routes(['register' => false]);
});


Route::get('/home', 'HomeController@index')->name('home');

<?php

use App\Http\Controllers\Dashboard\QualificationController;
use App\Models\Qualification;
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
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    Route::namespace('Dashboard')->middleware(['locale' , 'auth:admin'])->prefix('Dashboard')->group(function () {
        Route::get('' , 'DashboardController@index')->name('dashboard');

        // Qualification  Routes
        Route::get('qualifications' , 'QualificationController@index')->name('qualification.index');
        Route::get('qualifciations/{qualification}', 'QualificationController@edit')->name('qualification.edit');
        Route::put('qualifications/{qualification}' , 'QualificationController@update')->name('qualification.update');
        Route::delete('qualifications/{qualification}' , 'QualificationController@delete')->name('qualification.delete');
        Route::get('qualifications/create' , 'QualificationController@create')->name('qualification.create');
        Route::post('qualification' , 'QualificationController@store')->name('qualification.store');

        // Admins Routes
       Route::get('admins' , 'AdminController@index')->name('admin.index');
       Route::get('admins/{admin}', 'AdminController@edit')->name('admin.edit');
       Route::put('admins/{admin}', 'AdminController@update')->name('admin.update');
       Route::get('admin/create', 'AdminController@create')->name('admin.create');
       Route::post('admins', 'AdminController@store')->name('admin.store');
       Route::delete('admins/{admin}', 'AdminController@delete')->name('admin.delete');


    });

    // Login Routes
    Auth::routes(['register' => false]);
    Route::get('/home', 'HomeController@index')->name('home');
});


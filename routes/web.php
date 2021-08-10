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

Route::namespace('Dashboard')->middleware(['locale' , 'auth:admin'])->prefix('Dashboard')->group(function () {
    Route::get('datatables' , 'QualificationController@index')->name('qualification.index');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

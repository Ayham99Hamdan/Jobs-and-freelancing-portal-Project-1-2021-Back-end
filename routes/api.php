<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('auth')->group(function () {


    // start companies api routes 

    Route::post('company/register', 'CompanyController@register');
    Route::post('company/login', 'CompanyController@login');

    Route::prefix('company')->middleware(['auth:company', 'locale'])->group(function () {
        Route::post('logout', 'CompanyController@logout');
    });

    // end companies api routes

    // Start user api routes

    Route::post('user/register', 'UserController@register');
    Route::post('user/login', 'UserController@login');

    Route::prefix('user')->middleware('auth:user')->group(function () {
       // Route::namespace('User')->get('addEducation' , 'UserProfileController@addEducation');
        Route::post('logout', 'UserController@logout');
    });

    // end user api routes


});

Route::namespace('User')->prefix('user')->middleware('auth:user')->group(function () {
    // User Profile Update Route
    Route::post('updateUser', 'UserProfileController@updateUser');
    // Education Routes
    Route::post('addEducation' , 'UserProfileController@addEducation');
    Route::post('updateEducation' , 'UserProfileController@updateEducation');
    // Experience Routes
    Route::post('addExperience' , 'UserProfileController@addExperience');
    Route::post('updateExperience' , 'UserProfileController@updateExperience');
});

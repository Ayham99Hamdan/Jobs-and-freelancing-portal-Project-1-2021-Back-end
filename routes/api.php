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
// user api routes
Route::middleware('locale')->post('user/register', 'UserController@register');
Route::middleware('locale')->post('user/login', 'UserController@login');

Route::prefix('user')->middleware(['auth:user', 'locale' ])->group(function () {
    Route::post('logout', 'UserController@logout');
});

// end user api routes


// start companies api routes 

Route::middleware('locale')->post('company/register', 'auth\CompanyController@register');
Route::middleware('locale')->post('company/login', 'auth\CompanyController@login');

Route::prefix('company')->middleware(['auth:company', 'locale' ])->group(function () {
    Route::post('logout', 'auth\CompanyController@logout');
});

// end companies api routes
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

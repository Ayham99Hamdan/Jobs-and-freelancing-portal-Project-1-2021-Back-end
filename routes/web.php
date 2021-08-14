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
        Route::middleware('can:qualification read')->get('qualifications' , 'QualificationController@index')->name('qualification.index');
        Route::middleware('can:qualification update')->get('qualifictions/{qualification}', 'QualificationController@edit')->name('qualification.edit');
        Route::middleware('can:qualification update')->put('qualifications/{qualification}' , 'QualificationController@update')->name('qualification.update');
        Route::middleware('can:qualification delete')->delete('qualifications/{qualification}' , 'QualificationController@delete')->name('qualification.delete');
        Route::middleware('can:qualification create')->get('qualifications/create' , 'QualificationController@create')->name('qualification.create');
        Route::middleware('can:qualification create')->post('qualification' , 'QualificationController@store')->name('qualification.store');

        // Admins Routes
        Route::middleware('role:super-admin')->group(function () {
            Route::get('admins' , 'AdminController@index')->name('admin.index');
            Route::get('admins/{admin}', 'AdminController@edit')->name('admin.edit');
            Route::put('admins/{admin}', 'AdminController@update')->name('admin.update');
            Route::get('admin/create', 'AdminController@create')->name('admin.create');
            Route::post('admins', 'AdminController@store')->name('admin.store');
            Route::delete('admins/{admin}', 'AdminController@delete')->name('admin.delete');
        });
       

       // Job Roles Routes
       Route::middleware('can:job_role read')->get('job-roles' , 'JobRoleController@index')->name('jobRole.index');
        Route::middleware('can:job_role update')->get('job-roles/{jobRole}', 'JobRoleController@edit')->name('jobRole.edit');
        Route::middleware('can:job_role update')->put('job-roles/{jobRole}' , 'JobRoleController@update')->name('jobRole.update');
        Route::middleware('can:job_role delete')->delete('job-roles/{jobRole}' , 'JobRoleController@delete')->name('jobRole.delete');
        Route::middleware('can:job_role create')->get('job-role/create' , 'JobRoleController@create')->name('jobRole.create');
        Route::middleware('can:job_role create')->post('job-role' , 'JobRoleController@store')->name('jobRole.store');

        // Users Routes
        Route::middleware('can:user read')->get('users' , 'UserController@index')->name('user.index');
        Route::middleware('can:user show')->get('users/{user}' , 'UserController@show')->name('user.show');

        // Posts Routes
        Route::middleware('can:post read')->get('posts' , 'PostController@index')->name('post.index');
        Route::middleware('can:post show')->get('posts/{post}' , 'PostController@show')->name('post.show');
        Route::middleware('can:post show')->get('posts/approve/{post}' , 'PostController@approveToggle')->name('post.approve');

    });

    // Login Routes
    Auth::routes(['register' => false]);
    Route::get('/home', 'HomeController@index')->name('home');
});


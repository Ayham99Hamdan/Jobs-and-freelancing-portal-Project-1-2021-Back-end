<?php

use App\Http\Controllers\Company\CompanyManageController;
use App\Http\Controllers\Company\Post\ScheduleController;
use App\Http\Controllers\User\getUserProfileController;
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
// static data route
Route::middleware('locale')->resource('job-role' , 'JobRoleController')->only('index');
Route::middleware('locale')->resource('qualification' , 'QualificationController')->only('index');



Route::middleware('locale')->namespace('auth')->group(function () {


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

Route::namespace('User')->prefix('user')->middleware(['auth:user' , 'locale'])->group(function () {
    // User Profile Update Route
    Route::post('updateUser', 'UserProfileController@updateUserProfile');
    // Education Routes
    Route::post('addEducation' , 'UserProfileController@addEducation');
    Route::post('updateEducation/{id}' , 'UserProfileController@updateEducation');
    // Experience Routes
    Route::post('addExperience' , 'UserProfileController@addExperience');
    Route::post('updateExperience/{id}' , 'UserProfileController@updateExperience');
    // get user informations Routes
    Route::get('userProfile' , 'getUserProfileController@getUserProfile');
    // get user profile as CV
    Route::get('userCV' , 'UserProfileController@getCV');
    // get and control matched posts
    //Route::get('getPosts' , 'UserPostsController@getMatchedPosts');
    Route::get('getPosts' , 'UserPostsController@getPostByTag');
    // Reaction with this posts
    Route::get('reaction/{id}' , 'UserPostsController@reaction');
    //Schedule and Interview
    Route::post('schedule' , 'UserPostsController@viewSchedule');
    Route::post('interview-select' , 'UserPostsController@selectInterviewTime');
    Route::post('interview-deselect' , 'UserPostsController@deselectInterviewTime');

});


Route::namespace('Company')->prefix('company')->middleware(['auth:company' , 'locale'])->group(function () {
    Route::apiResource('post', 'CompanyManageController');
    Route::apiResource('schedule' , \Post\ScheduleController::class);
    Route::post('approve' , [CompanyManageController::class, 'approve']);
    Route::get('schedule/index/{post_id}' , [\App\Http\Controllers\Company\Post\ScheduleController::class , 'index']);
    Route::get('userprofile/{id}' , [getUserProfileController::class , 'getuserProfileById']);
});

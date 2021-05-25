<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ServiceController;
use \App\Http\Controllers\NotificationController;
use \App\Http\Controllers\JobController;
use \App\Http\Controllers\ExperienceController;
use \App\Http\Controllers\EvaluationController;
use \App\Http\Controllers\Contact_requestController;
use \App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Protected middleware
Route::group(['middleware' => ['auth:sanctum']], function () {

    // User
    Route::get('/user/list', [UserController::class, 'get_list']);
    Route::get('/user/search/{id}', [UserController::class, 'search']);

    Route::patch('/user/update', [UserController::class, 'update_user']);
    Route::delete('/user/delete', [UserController::class, 'delete_user']);

    Route::post('/service/add', [ServiceController::class, 'add_service']);
    Route::patch('/service/update', [ServiceController::class, 'update_service']);
    Route::delete('/service/delete', [ServiceController::class, 'delete_service']);

});

// Register a user
Route::post('/user/register', [UserController::class, 'add_user']);

// Login
Route::post('/user/login', [AuthController::class, 'authenticate']);

// Logout
Route::post('/user/logout', [AuthController::class, 'logout']);

// Professionals
Route::get('/user/professionals/list', [UserController::class, 'get_professionals']);

// User details
Route::get('/user/details/{id}', [UserController::class, 'get_details']);

// Clients
Route::get('/user/clients/list', [UserController::class, 'get_clients']);

// Upload image
Route::post('/upload/image', [UserController::class, 'upload_image']);

// Service
Route::get('/service/list', [ServiceController::class, 'get_list']);
Route::get('/service/search/{id}', [ServiceController::class, 'search']);

// Notification
Route::get('/notification/list', [NotificationController::class, 'get_list']);
Route::get('/notification/search/{id}', [NotificationController::class, 'search']);

Route::post('/notification/add', [NotificationController::class, 'add_notification']);
Route::patch('/notification/update', [NotificationController::class, 'update_notification']);
Route::delete('/notification/delete', [NotificationController::class, 'delete_notification']);

// Job
Route::get('/job/list', [JobController::class, 'get_list']);
Route::get('/job/search/{id}', [JobController::class, 'search']);

Route::post('/job/add', [JobController::class, 'add_job']);
Route::patch('/job/update', [JobController::class, 'update_job']);
Route::delete('/job/delete', [JobController::class, 'delete_job']);

// Experience
Route::get('/experience/list', [ExperienceController::class, 'get_list']);
Route::get('/experience/search/{id}', [ExperienceController::class, 'search']);

Route::post('/experience/add', [ExperienceController::class, 'add_experience']);
Route::patch('/experience/update', [ExperienceController::class, 'update_experience']);
Route::delete('/experience/delete', [ExperienceController::class, 'delete_experience']);

// Evaluation
Route::get('/evaluation/list', [EvaluationController::class, 'get_list']);
Route::get('/evaluation/search/{id}', [EvaluationController::class, 'search']);

Route::post('/evaluation/add', [EvaluationController::class, 'add_evaluation']);
Route::patch('/evaluation/update', [EvaluationController::class, 'update_evaluation']);
Route::delete('/evaluation/delete', [EvaluationController::class, 'delete_evaluation']);

// Contact request
Route::get('/contact_request/list', [Contact_requestController::class, 'get_list']);
Route::get('/contact_request/search/{id}', [Contact_requestController::class, 'search']);

Route::post('/contact_request/add', [Contact_requestController::class, 'add_contact_request']);
Route::patch('/contact_request/update', [Contact_requestController::class, 'update_contact_request']);
Route::delete('/contact_request/delete', [Contact_requestController::class, 'delete_contact_request']);

// Admin actions
Route::group(['middleware' => ['checkAdmin']], function () {
});

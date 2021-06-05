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
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\ConversationController;
use \App\Http\Controllers\RatingController;

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

    Route::post('/services/add', [ServiceController::class, 'add_service']);
    Route::patch('/services/update', [ServiceController::class, 'update_service']);
    Route::delete('/services/delete', [ServiceController::class, 'delete_service']);

});

Route::get('/services/list', [ServiceController::class, 'get_list']);

// Register a user
Route::post('/user/register', [UserController::class, 'add_user']);

// Login
Route::post('/user/login', [AuthController::class, 'authenticate']);

// Forgot password
Route::post('/user/forgot_password', [UserController::class, 'forgot_password']);

// Logout
Route::post('/user/logout', [AuthController::class, 'logout']);

// Professionals
Route::get('/user/professionals/list', [UserController::class, 'get_professionals']);

// User details
Route::get('/user/details/{id}', [UserController::class, 'get_details']);

// User details email
Route::get('/user/details', [UserController::class, 'get_details_email']);

// Clients
Route::get('/user/clients/list', [UserController::class, 'get_clients']);

// Upload image
Route::post('/upload/image', [UserController::class, 'upload_image']);

// Filter professionals list
Route::post('/user/professionals/filter', [UserController::class, 'filter_professionals']);

// Rating
Route::post('/user/rate', [RatingController::class, 'rate_user']);

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
Route::post('/evaluation/update', [EvaluationController::class, 'update']);
Route::post('/evaluation/get', [EvaluationController::class, 'get']);

// Contact request
Route::get('/contact_request/list', [Contact_requestController::class, 'get_list']);
Route::get('/contact_request/search/{id}', [Contact_requestController::class, 'search']);

Route::post('/contact_request/add', [Contact_requestController::class, 'add_contact_request']);
Route::patch('/contact_request/update', [Contact_requestController::class, 'update_contact_request']);
Route::delete('/contact_request/delete', [Contact_requestController::class, 'delete_contact_request']);

// Contact
Route::post('/comments/list', [CommentController::class, 'list']);
Route::post('/comments/add', [CommentController::class, 'add']);
Route::post('/comments/delete', [CommentController::class, 'delete']);

// Conversation
Route::post('/user/conversation/list', [ConversationController::class, 'list']);
Route::post('/user/conversation/add', [ConversationController::class, 'add']);
Route::post('/user/conversation/delete', [ConversationController::class, 'delete']);

// Admin actions
Route::group(['middleware' => ['checkAdmin']], function () {
});

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [App\Http\Controllers\API\AuthAPIController::class, 'login'])->name('login');
Route::post('register', [App\Http\Controllers\API\AuthAPIController::class, 'register'])->name('register');
Route::get('forget-password', [App\Http\Controllers\API\AuthAPIController::class, 'forgetPassword'])->name('forget_password');
Route::post('verify-password-reset-code', [App\Http\Controllers\API\AuthAPIController::class, 'verifyPasswordResetCode'])->name('verify_password_reset_code');
Route::post('update-password', [App\Http\Controllers\API\AuthAPIController::class, 'updatePassword'])->name('update_password');

Route::middleware('auth:sanctum')->group(function() {
    Route::resource('pages', App\Http\Controllers\API\PageAPIController::class);
    Route::resource('settings', App\Http\Controllers\API\SettingAPIController::class);
});

Route::resource('menus', App\Http\Controllers\API\MenuAPIController::class);
Route::get('get-aws-bucket-token', [App\Http\Controllers\API\AuthAPIController::class, 'awsBucketToken'])->name('get_aws_bucket_token');


Route::resource('constants', App\Http\Controllers\API\ConstantAPIController::class);
Route::resource('stacks', App\Http\Controllers\API\StackAPIController::class);


Route::resource('employees', App\Http\Controllers\API\EmployeeAPIController::class);


Route::resource('projects', App\Http\Controllers\API\ProjectAPIController::class);


Route::resource('user_details', App\Http\Controllers\API\UserDetailAPIController::class);

<?php

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
Route::post('forget-password', [App\Http\Controllers\API\AuthAPIController::class, 'forgetPassword'])->name('forget_password');
Route::post('reset-password', [App\Http\Controllers\API\AuthAPIController::class, 'resetPassword'])->name('reset_password');
Route::post('resend-otp', [\App\Http\Controllers\API\AuthAPIController::class, 'resendOTP']);
Route::post('verify-otp', [\App\Http\Controllers\API\AuthAPIController::class, 'verifyOTP']);
Route::post('social-login', [App\Http\Controllers\API\AuthAPIController::class, 'socialLogin']);


Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::delete('delete-account', [App\Http\Controllers\API\AuthAPIController::class, 'deleteAccount']);
    Route::get('my-profile', [App\Http\Controllers\API\UserAPIController::class, 'myProfile']);
    Route::put('update-profile', [App\Http\Controllers\API\UserAPIController::class, 'updateProfile']);

    Route::resource('pages', App\Http\Controllers\API\PageAPIController::class);
    Route::resource('settings', App\Http\Controllers\API\SettingAPIController::class);


    Route::post('change-password', [App\Http\Controllers\API\AuthAPIController::class, 'changePassword'])->name('change_password');
    Route::post('logout', [App\Http\Controllers\API\AuthAPIController::class, 'logout'])->name('logout');

});

Route::resource('menus', App\Http\Controllers\API\MenuAPIController::class);
Route::get('get-aws-bucket-token', [App\Http\Controllers\API\AuthAPIController::class, 'awsBucketToken'])->name('get_aws_bucket_token');

Route::resource('constants', App\Http\Controllers\API\ConstantAPIController::class);

Route::resource('user_details', App\Http\Controllers\API\UserDetailAPIController::class);


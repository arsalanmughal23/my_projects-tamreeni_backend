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

// Route::post('verify-password-reset-code', [App\Http\Controllers\API\AuthAPIController::class, 'verifyPasswordResetCode'])->name('verify_password_reset_code');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('my-profile', [App\Http\Controllers\API\UserAPIController::class, 'myProfile']);
    Route::put('update-profile', [App\Http\Controllers\API\UserAPIController::class, 'updateProfile']);

    Route::post('change-password', [App\Http\Controllers\API\AuthAPIController::class, 'changePassword'])->name('change_password');
    Route::post('logout', [App\Http\Controllers\API\AuthAPIController::class, 'logout'])->name('logout');
    Route::delete('delete-account', [App\Http\Controllers\API\AuthAPIController::class, 'deleteAccount']);

    Route::resource('faqs', App\Http\Controllers\API\FaqAPIController::class);
    Route::get('profile', [App\Http\Controllers\API\UserDetailAPIController::class, 'getUserProfile']);
    Route::put('update-language', [App\Http\Controllers\API\UserDetailAPIController::class, 'updateLanguage']);
    Route::resource('wellness_tips', App\Http\Controllers\API\WellnessTipAPIController::class);
    Route::resource('settings', App\Http\Controllers\API\SettingAPIController::class);

    Route::resource('favourites', App\Http\Controllers\API\FavouriteAPIController::class);
    Route::post('favorite', [App\Http\Controllers\API\FavouriteAPIController::class, 'markAsFavorite']);
    Route::post('mark-interested', [App\Http\Controllers\API\EventAPIController::class, 'markInterested']);
    Route::get('search', [App\Http\Controllers\API\MealAPIController::class, 'searchMeals']);
    Route::resource('meal_categories', App\Http\Controllers\API\MealCategoryAPIController::class);
    Route::resource('meals', App\Http\Controllers\API\MealAPIController::class);
    Route::resource('events', App\Http\Controllers\API\EventAPIController::class);
    Route::resource('user_events', App\Http\Controllers\API\UserEventAPIController::class);

});

Route::resource('menus', App\Http\Controllers\API\MenuAPIController::class);
Route::get('get-aws-bucket-token', [App\Http\Controllers\API\AuthAPIController::class, 'awsBucketToken'])->name('get_aws_bucket_token');

Route::resource('constants', App\Http\Controllers\API\ConstantAPIController::class);
Route::resource('pages', App\Http\Controllers\API\PageAPIController::class);

Route::resource('user_details', App\Http\Controllers\API\UserDetailAPIController::class);
Route::get('page-content', [App\Http\Controllers\API\PageAPIController::class, 'pageContent'])->name('page-content');


Route::resource('body_parts', App\Http\Controllers\API\BodyPartAPIController::class);


Route::resource('exercise_equipments', App\Http\Controllers\API\ExerciseEquipmentAPIController::class);





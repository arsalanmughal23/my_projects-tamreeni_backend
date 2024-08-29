<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
Route::get('page-content', [App\Http\Controllers\API\PageAPIController::class, 'pageContent'])->name('page-content');


Route::middleware(['auth:sanctum', 'verified', 'setLocale'])->group(function () {

    Route::put('update-profile', [App\Http\Controllers\API\UserAPIController::class, 'updateProfile']);
    Route::post('check_promo_code', [App\Http\Controllers\API\PromoCodeAPIController::class, 'checkPromoCode']);
    Route::post('purchase_memberships', [App\Http\Controllers\API\UserMembershipAPIController::class, 'purchaseMembership']);
    Route::post('use_trail', [App\Http\Controllers\API\UserMembershipAPIController::class, 'useMembershipTrail']);

    Route::resource('memberships', App\Http\Controllers\API\MembershipAPIController::class)->only('index');
    Route::resource('membership_durations', App\Http\Controllers\API\MembershipDurationAPIController::class);
    Route::get('my-profile', [App\Http\Controllers\API\UserAPIController::class, 'myProfile']);
    Route::resource('user_memberships', App\Http\Controllers\API\UserMembershipAPIController::class);
    Route::delete('delete-account', [App\Http\Controllers\API\AuthAPIController::class, 'deleteAccount']);

    Route::post('test-notification', [App\Http\Controllers\API\NotificationAPIController::class, 'testNotification']);


    Route::post('change-password', [App\Http\Controllers\API\AuthAPIController::class, 'changePassword'])->name('change_password');
    Route::post('logout', [App\Http\Controllers\API\AuthAPIController::class, 'logout'])->name('logout');
    Route::get('profile', [App\Http\Controllers\API\UserDetailAPIController::class, 'getUserProfile']);
    Route::resource('faqs', App\Http\Controllers\API\FaqAPIController::class);
    Route::put('update-language', [App\Http\Controllers\API\UserDetailAPIController::class, 'updateLanguage']);
    Route::resource('wellness_tips', App\Http\Controllers\API\WellnessTipAPIController::class);
    Route::resource('settings', App\Http\Controllers\API\SettingAPIController::class);
    Route::resource('favourites', App\Http\Controllers\API\FavouriteAPIController::class);
    Route::post('favorite', [App\Http\Controllers\API\FavouriteAPIController::class, 'markAsFavorite']);
    Route::post('mark-interested', [App\Http\Controllers\API\EventAPIController::class, 'markInterested']);
    Route::get('search', [App\Http\Controllers\API\MealAPIController::class, 'search']);
    Route::resource('meal_categories', App\Http\Controllers\API\MealCategoryAPIController::class);
    Route::resource('meals', App\Http\Controllers\API\MealAPIController::class);
    Route::resource('events', App\Http\Controllers\API\EventAPIController::class);
    Route::resource('slots', App\Http\Controllers\API\SlotAPIController::class);
    Route::get('user-slots', [App\Http\Controllers\API\SlotAPIController::class, 'userSlots']);
    Route::resource('user_events', App\Http\Controllers\API\UserEventAPIController::class);
    Route::resource('exercises', App\Http\Controllers\API\ExerciseAPIController::class);
    Route::resource('body_parts', App\Http\Controllers\API\BodyPartAPIController::class);
    Route::resource('exercise_equipments', App\Http\Controllers\API\ExerciseEquipmentAPIController::class);
    Route::resource('exercise_equipment_pivots', App\Http\Controllers\API\ExerciseEquipmentPivotAPIController::class);

    Route::resource('questions', App\Http\Controllers\API\QuestionAPIController::class)->only('index');
    Route::post('submit_answers', [App\Http\Controllers\API\QuestionAPIController::class, 'submitAnswers']);
    Route::get('personal_statistics', [App\Http\Controllers\API\UserAPIController::class, 'getPersonalStatistics']);

    Route::resource('contact_requests', App\Http\Controllers\API\ContactRequestAPIController::class);
    Route::resource('transactions', App\Http\Controllers\API\TransactionAPIController::class);
    Route::resource('user_subscriptions', App\Http\Controllers\API\UserSubscriptionAPIController::class);
    Route::get('generate-workout-plan', [App\Http\Controllers\API\UserAPIController::class, 'generatePlans']);
    Route::resource('question_answer_attempts', App\Http\Controllers\API\QuestionAnswerAttemptAPIController::class);


    Route::resource('recipes', App\Http\Controllers\API\RecipeAPIController::class);
    Route::resource('recipe_ingredients', App\Http\Controllers\API\RecipeIngredientAPIController::class);

    Route::resource('nutrition_plan_day_recipes', App\Http\Controllers\API\NutritionPlanDayRecipeAPIController::class);
    Route::resource('nplan_day_recipe_ingredients', App\Http\Controllers\API\NplanDayRecipeIngredientAPIController::class);


    Route::middleware(['userMembership'])->group(function () {
        Route::resource('user-list', App\Http\Controllers\API\UserAPIController::class);

        Route::resource('appointments', App\Http\Controllers\API\AppointmentAPIController::class);
        Route::resource('packages', App\Http\Controllers\API\PackageAPIController::class);


        Route::get('user-current-package', [App\Http\Controllers\API\UserSubscriptionAPIController::class, 'userCurrentPackage']);

        Route::post('payments/create-customer', [App\Http\Controllers\API\PaymentController::class, 'createCustomer']);


        Route::resource('meal_types', App\Http\Controllers\API\MealTypeAPIController::class);
        Route::resource('workout-days', App\Http\Controllers\API\WorkoutDayAPIController::class);
        Route::resource('workout-day-exercises', App\Http\Controllers\API\WorkoutDayExerciseAPIController::class);
        Route::resource('workout-plans', App\Http\Controllers\API\WorkoutPlanAPIController::class);

        Route::resource('nutrition-plans', App\Http\Controllers\API\NutritionPlanAPIController::class);

        Route::resource('nutrition-plan-days', App\Http\Controllers\API\NutritionPlanDayAPIController::class);
        Route::put('user-meal-consumed/{nutritionPlanDayMealId}', [App\Http\Controllers\API\NutritionPlanDayMealAPIController::class, 'userMealConsumed']);
        Route::put('user-recipe-consumed/{nutritionPlanDayRecipeId}', [App\Http\Controllers\API\NutritionPlanDayMealAPIController::class, 'userRecipeConsumed']);
        Route::post('user-additional-meal-consumed', [App\Http\Controllers\API\NutritionPlanDayMealAPIController::class, 'userAdditionalMealConsumed']);


        Route::resource('nutrition-plan-day-meals', App\Http\Controllers\API\NutritionPlanDayMealAPIController::class)->only('index', 'show');
        Route::resource('nutrition-plan-day-recipes', App\Http\Controllers\API\NutritionPlanDayRecipeAPIController::class)->only('index', 'show');


        Route::resource('options', App\Http\Controllers\API\OptionAPIController::class);

        Route::resource('meal_breakdowns', App\Http\Controllers\API\MealBreakdownAPIController::class);


        // Route::resource('promo_codes', App\Http\Controllers\API\PromoCodeAPIController::class);
        // Route::resource('used_promo_codes', App\Http\Controllers\API\UsedPromoCodeAPIController::class);


        Route::resource('menus', App\Http\Controllers\API\MenuAPIController::class);
        Route::get('get-aws-bucket-token', [App\Http\Controllers\API\AuthAPIController::class, 'awsBucketToken'])->name('get_aws_bucket_token');
        Route::resource('constants', App\Http\Controllers\API\ConstantAPIController::class);
        Route::resource('pages', App\Http\Controllers\API\PageAPIController::class);
    });
});




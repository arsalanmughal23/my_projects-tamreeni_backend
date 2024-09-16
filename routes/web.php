<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return redirect()->route('login');
});
// Auth::routes();
Auth::routes(['register' => false]);
// Auth::routes();

Route::get('/cache-clear', function(){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    return 'done';
});

Route::get('/payment-page', [App\Http\Controllers\PayTabsController::class, 'create_payment_page'])->name('payment-page');
Route::get('/query-transaction', [App\Http\Controllers\PayTabsController::class, 'query_transaction'])->name('query-transaction');
Route::post('/paytabs-return', [App\Http\Controllers\PayTabsController::class, 'payTabs_return'])->name('paytabs-return');
Route::post('/paytabs-callback', [App\Http\Controllers\PayTabsController::class, 'callBackFunction'])->name('paytabs-callback');

Route::group(['middleware' => ['auth', 'verified:web']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['dynamic_permission']], function () {
        Route::resource('users', App\Http\Controllers\UsersController::class);

        Route::get('check-user-generatable-plans/{user}', [App\Http\Controllers\API\UserAPIController::class, 'checkUserGeneratablePlans'])->name('check-user-generatable-plans');

        Route::post('/generate-crud-from-table', [App\Http\Controllers\GenerateTableController::class, 'generateCrudFromTable'])->name('dbtables.generate_crud_from_table');

        Route::get('/create-menus', [App\Http\Controllers\GenerateTableController::class, 'createMenu'])->name('dbtables.create_menus');

        Route::get('/delete-menus', [App\Http\Controllers\GenerateTableController::class, 'deleteMenu'])->name('dbtables.delete_menus');

        Route::get('/generated-crud-delete-permissions', [App\Http\Controllers\GenerateTableController::class, 'deletePermissions'])->name('dbtables.generated_crud_delete_permissions');

        Route::get('/run_artisan_command/{id}', [App\Http\Controllers\GenerateTableController::class, 'runArtisanCommand'])->name('dbtables.run_artisan_command');

        Route::get('/create_permissions/{id}', [App\Http\Controllers\GenerateTableController::class, 'createPermissions'])->name('dbtables.create_permissions');

        Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

        Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

        Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

        Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

        Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

        Route::post(
            'generator_builder/generate-from-file',
            '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
        )->name('io_generator_builder_generate_from_file');


        Route::get('/users/assignroles/{id}', [App\Http\Controllers\UsersController::class, 'assignRoles'])->name('users.assignroles');
        Route::patch('/users/updateroles/{id}', [App\Http\Controllers\UsersController::class, 'updateRoles'])->name("roles.rolesupdate");

        Route::get('/roles/assignpermissions/{id}', [App\Http\Controllers\RolesController::class, 'assignPermissions'])->name('roles.assignpermissions');
        Route::patch('/roles/updatepermissions/{id}', [App\Http\Controllers\RolesController::class, 'updatePermissions'])->name("roles.permissionsupdate");

        Route::resource('menus', App\Http\Controllers\MenuController::class);

        Route::resource('roles', App\Http\Controllers\RolesController::class)->only('index', 'edit', 'update', 'show');

        Route::resource('permissions', App\Http\Controllers\PermissionsController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::resource('meals', App\Http\Controllers\MealController::class);

        Route::resource('meal_types', App\Http\Controllers\MealTypeController::class)->only('index', 'edit', 'update', 'show');

        Route::resource('meal_categories', App\Http\Controllers\MealCategoryController::class)->only('index', 'edit', 'update', 'show');

        Route::resource('transactions', App\Http\Controllers\TransactionController::class);

        Route::resource('pages', App\Http\Controllers\PageController::class)->only('index', 'edit', 'update', 'show', 'destroy');

        Route::resource('settings', App\Http\Controllers\SettingController::class);


        Route::resource('constants', App\Http\Controllers\ConstantController::class);


        Route::resource('user_details', App\Http\Controllers\UserDetailController::class);


        Route::resource('faqs', App\Http\Controllers\FaqController::class);


        Route::resource('wellness_tips', App\Http\Controllers\WellnessTipController::class);


        Route::resource('favourites', App\Http\Controllers\FavouriteController::class);


        Route::resource('body_parts', App\Http\Controllers\BodyPartController::class);


        Route::resource('exercise_equipments', App\Http\Controllers\ExerciseEquipmentController::class);


        Route::resource('events', App\Http\Controllers\EventController::class);


        Route::resource('user_events', App\Http\Controllers\UserEventController::class);


        Route::resource('exercises', App\Http\Controllers\ExerciseController::class);


        Route::resource('exercise_equipment_pivots', App\Http\Controllers\ExerciseEquipmentPivotController::class);


        Route::resource('contact_requests', App\Http\Controllers\ContactRequestController::class);


        Route::resource('slots', App\Http\Controllers\SlotController::class);


        Route::resource('appointments', App\Http\Controllers\AppointmentController::class);


        Route::resource('packages', App\Http\Controllers\PackageController::class);


        Route::resource('user_subscriptions', App\Http\Controllers\UserSubscriptionController::class);


        Route::resource('workout_days', App\Http\Controllers\WorkoutDayController::class);


        Route::resource('workout_day_exercises', App\Http\Controllers\WorkoutDayExerciseController::class);


        Route::resource('workout_plans', App\Http\Controllers\WorkoutPlanController::class);


        Route::resource('nutrition_plans', App\Http\Controllers\NutritionPlanController::class);


        Route::resource('nutrition_plan_days', App\Http\Controllers\NutritionPlanDayController::class);


        Route::resource('nutrition_plan_day_meals', App\Http\Controllers\NutritionPlanDayMealController::class);

        Route::resource('questions', App\Http\Controllers\QuestionController::class);

        Route::resource('options', App\Http\Controllers\OptionController::class);

        Route::resource('question_answer_attempts', App\Http\Controllers\QuestionAnswerAttemptController::class);

        Route::resource('meal_breakdowns', App\Http\Controllers\MealBreakdownController::class);

        Route::resource('recipes', App\Http\Controllers\RecipeController::class);
        Route::resource('recipe_ingredients', App\Http\Controllers\RecipeIngredientController::class);

        Route::resource('nutrition_plan_day_recipes', App\Http\Controllers\NutritionPlanDayRecipeController::class)->only('index', 'show', 'edit', 'update');
        Route::resource('nplan_day_recipe_ingredients', App\Http\Controllers\NplanDayRecipeIngredientController::class);

        Route::resource('promo_codes', App\Http\Controllers\PromoCodeController::class);
        Route::resource('used_promo_codes', App\Http\Controllers\UsedPromoCodeController::class)->only('index', 'show', 'destroy');

        Route::resource('memberships', App\Http\Controllers\MembershipController::class);
        Route::resource('membership_durations', App\Http\Controllers\MembershipDurationController::class);
        Route::resource('user_memberships', App\Http\Controllers\UserMembershipController::class)->only('index', 'show', 'destroy');
    });
});

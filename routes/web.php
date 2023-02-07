<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'dynamic_permission']], function () {

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

    Route::resource('roles', App\Http\Controllers\RolesController::class);

    Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

});

Route::resource('users', App\Http\Controllers\UsersController::class);





Route::resource('pages', App\Http\Controllers\PageController::class);

Route::resource('settings', App\Http\Controllers\SettingController::class);


Route::resource('constants', App\Http\Controllers\ConstantController::class);


Route::resource('stacks', App\Http\Controllers\StackController::class);


Route::resource('employees', App\Http\Controllers\EmployeeController::class);

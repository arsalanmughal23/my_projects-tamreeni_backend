# Laravel 8 Boilerplate

Basic boilerplate to create laravel projects with Admin Panel, Role Based Access Control and Dynamic Menus generate .

# Features 

**Generate Table with Table**

- Put you data on required selection and input field system will automatically create table in your database and will create curd in you project .


**Rollback Module**

- You can easily revert back you generated crud.

**Generate Table from Database Table**

- You should design your database through your preferred Database Administration tool then generate modules from the admin panel.

## Whats used?
- **PHP ^8.0** 
- **Laravel 8.75**
- InfyOm Laravel Generator
- AdminLTE Theme
- DataTables
- Spatie (ACL)
- Repository Pattern

## Libraries
**Laravel 8.75**

- laravel/framework: ^8.75,
- laravel/sanctum: ^2.11,
- laravel/tinker: ^2.5,
- laravel/ui: ^3.4,
- laravelcollective/html: ^6.2,
- doctrine/dbal: ~2.3,

**InfyOm (with AdminLTE Template and DataTables)**

- infyomlabs/adminlte-templates: ^3.0,
- infyomlabs/generator-builder: ^1.0,
- infyomlabs/laravel-generator: ^3.0,
- yajra/laravel-datatables-buttons: ^4.13,
- yajra/laravel-datatables-html: ^4.41,
- yajra/laravel-datatables-oracle: ^9.21,
- infyomlabs/routes-explorer: ^1.0

**Spatie (ACL)**
- spatie/laravel-permission: ^5.7,

## Installation
- Download or Clone the zip of this repository 
- Upload it on Web Server
- Install libraries with `composer install`
- Run Migration and Seeder `php artisan migrate:refresh --seed`
- Run optimize or clear cache commands `php artisan optimize:clear` 

Boilerplate will create tables and insert basic users, roles, permissions in the database. 

## How To?
**Step 1**

- Make Schema Architecture in your preferred database administration tool.
- Click on Generator Builder.
- Scroll and go to **Crud Generator From Table** section.
- Select the table you want to create a module for.
- Check Custom Model Name checkbox if you need and enter Model Name (Only alphanumeric characters and spaces are not allowed for module names. Use CamelCase for module name and it will add underscore in your routes and permission names).
- Table name should be plural name with created_at(datetime) default(current timestamp), updated_at(datetime) default(current timestamp) and deleted_at(datetime) default(null) columns.

**Check Generated Files:**

- DataTable, 
- Admin Controller, 
- Api Controller, 
- Request, 
- Model, 
- Repositories, 
- Migrations, 
- Views, 
- Tests,
- Tests Traits,
- routes/api.php, 
- routes/admin.php,
- resources/model_schemas/Module.json,

## Admin Credentials:
- Super admin (development admin)
    - 'email'    => "super-admin@boilerplate.com"
    - 'password' => '123456'


---
## _Build Something Amazing!!_

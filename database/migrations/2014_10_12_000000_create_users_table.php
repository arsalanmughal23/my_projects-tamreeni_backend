<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', ['pending', 'active', 'in-active'])->default('pending'); // CONSTANT: pending, active, in-active

            $table->rememberToken();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('dob')->nullable();
            $table->text('image')->nullable();

            $table->tinyInteger('is_social_login')->default(0)->comment('0,1');
            $table->tinyInteger('push_notification')->default(0)->comment('0,1');

            $table->enum('gender', ['male', 'female'])->nullable()->comment('male, female'); // CONSTANT: male, female
            $table->enum('language', ['en', 'ar'])->nullable()->comment('en, ar'); // CONSTANT: en, ar

            $table->float('height_in_m')->nullable()->default(0);
            $table->float('current_weight_in_kg')->nullable()->default(0);
            $table->float('target_weight_in_kg')->nullable()->default(0);

            $table->unsignedBigInteger('goal_id')->nullable()->comment('goal'); // CONSTANT: lose_weight, gain_weight, build_muscle, get_fit
            $table->unsignedBigInteger('height_unit_id')->nullable()->comment('height_unit'); // CONSTANT: cm, m
            $table->unsignedBigInteger('current_weight_unit_id')->nullable()->comment('weight_unit'); // CONSTANT: kg, lbs
            $table->unsignedBigInteger('target_weight_unit_id')->nullable()->comment('weight_unit'); // CONSTANT: kg, lbs
            $table->unsignedBigInteger('diet_type_id')->nullable()->comment('diet_type'); // CONSTANT: traditional, keto

            $table->unsignedBigInteger('delete_account_type_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('device_type')->comment('ios, android, web');
            $table->text('device_token');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('user_social_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('platform');
            $table->string('client_id');
            $table->text('token');
            $table->timestamp('expires_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0,1');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if(Schema::hasTable('user_details')){
            Schema::table('user_details', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        
        if(Schema::hasTable('user_devices')){
            Schema::table('user_devices', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        
        if(Schema::hasTable('user_social_accounts')){
            Schema::table('user_social_accounts', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        Schema::dropIfExists('user_social_accounts');
        Schema::dropIfExists('user_devices');
        Schema::dropIfExists('user_details');
        Schema::dropIfExists('users');
    }
}
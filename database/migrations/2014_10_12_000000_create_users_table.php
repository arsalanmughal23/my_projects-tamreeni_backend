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
        
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('stripe_customer_id')->nullable();
                $table->string('name')->nullable();
                $table->string('email');
                $table->string('password');
                $table->timestamp('email_verified_at')->nullable();
                $table->enum('status', ['pending', 'active', 'in-active'])->default('pending'); // CONSTANT: pending, active, in-active
                $table->timestamp('trail_expire_at')->nullable();

                $table->rememberToken();

                $table->softDeletes();
                $table->timestamps();
            });
        }
        
        if (!Schema::hasTable('user_details')) {
            Schema::create('user_details', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('user_id');
                
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('address')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('phone_number_country_code')->nullable();
                $table->date('dob')->nullable();
                $table->integer('age')->default(0)->nullable();
                $table->text('image')->nullable();
                
                $table->tinyInteger('is_social_login')->default(0)->comment('0,1');
                $table->tinyInteger('push_notification')->default(1)->comment('0,1');

                $table->enum('gender', ['male', 'female'])->nullable()->comment('male, female'); // CONSTANT: male, female
                $table->enum('language', ['en', 'ar'])->nullable()->comment('en, ar'); // CONSTANT: en, ar

                $table->string('goal')->nullable()->comment('goal'); // CONSTANT: lose_weight, gain_weight, build_muscle, get_fit
                
                $table->string('workout_days_in_a_week')->nullable()->comment('workout_days_in_a_week');
                $table->string('how_long_time_to_workout')->nullable()->comment('for making an impact on workout plan for assigning exercises');
                $table->string('workout_duration_per_day')->nullable()->comment('workout_duration_per_day');
                $table->string('equipment_type')->nullable()->comment('equipment_type');
                
                $table->float('height_in_cm')->nullable()->default(0);
                $table->float('height')->nullable()->default(0);
                $table->string('height_unit')->nullable()->comment('height_unit'); // CONSTANT: cm, ft
                $table->float('current_weight_in_kg')->nullable()->default(0);
                $table->float('current_weight')->nullable()->default(0);
                $table->string('current_weight_unit')->nullable()->comment('weight_unit'); // CONSTANT: kg, lbs
                $table->float('target_weight_in_kg')->nullable()->default(0);
                $table->float('target_weight')->nullable()->default(0);
                $table->string('target_weight_unit')->nullable()->comment('weight_unit'); // CONSTANT: kg, lbs

                $table->date('reach_goal_target_date')->nullable()->comment('reach_goal_target_date');
                $table->string('body_parts')->default(json_encode([]))->comment('body_parts');
                
                $table->string('physically_active')->nullable()->comment('physically_active');

                $table->string('level')->nullable()->comment('level');
                $table->float('squat__one_rep_max_in_kg')->nullable()->default(0);
                $table->float('deadlift__one_rep_max_in_kg')->nullable()->default(0);
                $table->float('bench__one_rep_max_in_kg')->nullable()->default(0);
                $table->float('overhead__one_rep_max_in_kg')->nullable()->default(0);
                
                $table->string('health_status')->nullable();
                $table->string('daily_steps_taken')->nullable();
                
                $table->string('diet_type')->nullable()->comment('diet_type'); // CONSTANT: traditional, keto
                $table->string('food_preferences')->default(json_encode([]))->comment('food_preferences');
                
                $table->float('calories')->default(0.00);
                $table->float('algo_required_calories')->default(0.00);
                $table->boolean('is_last_attempt_plan_generated')->default(0);
                $table->float('bmi')->default(0.00);
                
                $table->unsignedBigInteger('unplaned_answer_attempt_id')->nullable();
                $table->unsignedBigInteger('planed_answer_attempt_id')->nullable();

                $table->unsignedBigInteger('delete_account_type_id')->nullable();
                $table->softDeletes();
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('user_devices')) {
            Schema::create('user_devices', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('user_id');
                $table->string('device_type')->comment('ios, android, web');
                $table->text('device_token');
                
                $table->softDeletes();
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
        
        if (!Schema::hasTable('user_social_accounts')) {
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
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnswerAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answer_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->date('dob')->nullable();
            $table->integer('age')->default(0)->nullable();
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
            $table->float('bmi')->default(0.00);

            $table->string('status')->default('pending')->comment('pending', 'active', 'cancel', 'terminate');

            $table->unsignedBigInteger('workout_plan_id')->nullable();
            $table->unsignedBigInteger('nutrition_plan_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_answer_attempts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutDayExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_day_exercises', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('exercise_category_name')->nullable()->comment('major_lift','accessory_movement','multi_joint','single_joint','cardio');
            $table->string('exercise_type_name')->nullable()->comment('squat','deadlift','bench','overhead');
            $table->text('description')->nullable();
            $table->float('duration_in_m')->nullable();
            $table->integer('sets')->nullable(false);
            $table->integer('reps')->nullable(false);
            $table->float('weight_in_kg')->default(0);
            $table->double('burn_calories', 8, 2)->nullable(false);
            $table->text('image')->nullable();
            $table->text('audio')->nullable();
            $table->text('video')->nullable();
            $table->integer('status')->nullable(false);

            $table->integer('body_part_id')->unsigned();
            $table->unsignedBigInteger('workout_day_id');
            $table->unsignedInteger('exercise_id');

            $table->boolean('is_finisher')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('workout_day_id')->references('id')->on('workout_days')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
            $table->foreign('body_part_id')->references('id')->on('body_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workout_day_exercises');
    }
}

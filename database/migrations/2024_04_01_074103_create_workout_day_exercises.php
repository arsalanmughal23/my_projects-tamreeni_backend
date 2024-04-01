<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutDayExercises extends Migration
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
            $table->unsignedBigInteger('workout_day_id');
            $table->foreign('workout_day_id')->references('id')->on('workout_days')->onDelete('cascade');
            $table->unsignedInteger('exercise_id');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
            $table->integer('duration')->nullable(false);
            $table->integer('sets')->nullable(false);
            $table->integer('reps')->nullable(false);
            $table->double('burn_calories', 8, 2)->nullable(false);
            $table->integer('status')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
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

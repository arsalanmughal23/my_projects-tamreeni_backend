<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('body_part_id')->unsigned();
            $table->text('name');
            $table->string('exercise_category_name')->nullable()->comment('major_lift','accessory_movement','multi_joint','single_joint','cardio');
            $table->string('exercise_type_name')->nullable()->comment('squat','deadlift','bench','overhead');
            $table->text('description')->nullable();
            $table->float('duration_in_m')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('reps')->nullable();
            $table->float('burn_calories')->nullable();
            $table->text('image')->nullable();
            $table->text('audio')->nullable();
            $table->text('video')->nullable();
            $table->text('record')->nullable();
            $table->boolean('is_finisher')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('exercises');
    }
}

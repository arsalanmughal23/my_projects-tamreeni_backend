<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_plan_id');
            $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
            $table->string('name', 255)->nullable(false);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->date('date')->nullable(false);
            $table->integer('duration')->nullable(false);
            $table->integer('status')->default(10)->nullable(false);
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
        Schema::dropIfExists('workout_days');
    }
}

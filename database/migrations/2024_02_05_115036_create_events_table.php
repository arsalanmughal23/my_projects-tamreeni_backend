<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('duration')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('record_video_url')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('body_part_id')->unsigned()->nullable();
            $table->integer('equipment_id')->unsigned()->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('body_part_id')->references('id')->on('body_parts')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('exercise_equipments')->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}

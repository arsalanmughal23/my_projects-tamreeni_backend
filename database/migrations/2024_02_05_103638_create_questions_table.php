<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('cover_image')->nullable();
            $table->string('answer_mode')->comment('single_select, multi_select, date, number, number_with_unit'); //single_select, multi_select, date, number
            $table->string('question_variable_name')->comment('workout_days_in_a_week, equipment_type, body_parts, level'); // workout_days_in_a_week, equipment_type, body_parts, level
            $table->string('question_secondary_variable_name')->nullable();

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
        Schema::dropIfExists('questions');
    }
}

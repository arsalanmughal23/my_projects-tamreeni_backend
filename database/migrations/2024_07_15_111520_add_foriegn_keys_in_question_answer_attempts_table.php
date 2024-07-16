<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForiegnKeysInQuestionAnswerAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_answer_attempts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
            $table->foreign('nutrition_plan_id')->references('id')->on('nutrition_plans')->onDelete('cascade');
        });
        
        if (Schema::hasTable('user_details')) {
            Schema::table('user_details', function (Blueprint $table) {
                $table->foreign('planed_answer_attempt_id')->references('id')->on('question_answer_attempts')->restrictOnDelete('cascade');
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
        Schema::table('question_answer_attempts', function (Blueprint $table) {            
            $table->dropForeign(['user_id']);
            $table->dropForeign(['workout_plan_id']);
            $table->dropForeign(['nutrition_plan_id']);
        });
        
        if (Schema::hasTable('user_details')) {
            Schema::table('user_details', function (Blueprint $table) {     
                $table->dropForeign(['planed_answer_attempt_id']);
            });
        }

        Schema::dropIfExists('question_answer_attempts');
    }
}

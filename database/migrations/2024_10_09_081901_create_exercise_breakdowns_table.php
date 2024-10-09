<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseBreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_breakdowns', function (Blueprint $table) {
            $table->id();
            $table->enum('goal', ['lose_weight', 'gain_weight', 'build_muscle', 'get_fit']);
            $table->enum('how_long_time_to_workout', ['30_mins', '45_mins', '1_hour', 'more_than_1_hour']);
            $table->enum('exercise_category', ['major_lift', 'single_joint', 'multi_joint', 'cardio']);
            $table->unsignedBigInteger('exercise_count')->default(0);
            $table->string('sets')->nullable();
            $table->string('reps')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('exercise_breakdowns');
    }
}

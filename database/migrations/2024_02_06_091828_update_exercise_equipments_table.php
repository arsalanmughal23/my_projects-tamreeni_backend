<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExerciseEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exercise_equipments', function (Blueprint $table) {
            $table->enum('type', ['All Equipments', 'Machines', 'Free Weights', 'No Equipment At All'])->nullable()->comment('all_equipments, machines, free_weights, no_equipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exercise_equipments', function (Blueprint $table) {
            $table->dropColumn('type');

        });
    }
}

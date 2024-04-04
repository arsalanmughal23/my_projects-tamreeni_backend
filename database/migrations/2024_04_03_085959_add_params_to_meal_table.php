<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParamsToMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->double('carbs', 8, 2)->after('calories')->default(0)->nullable(false);
            $table->double('fats', 8, 2)->after('calories')->default(0)->nullable(false);
            $table->double('protein', 8, 2)->after('calories')->default(0)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            //
        });
    }
}

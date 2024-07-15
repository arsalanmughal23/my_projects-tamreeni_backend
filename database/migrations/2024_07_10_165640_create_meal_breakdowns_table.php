<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealBreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_breakdowns', function (Blueprint $table) {
            $table->id();
            $table->enum('diet_type', ['traditional', 'keto']);
            $table->bigInteger('total_calories');
            $table->unsignedBigInteger('breakfast_units')->default(0);
            $table->unsignedBigInteger('lunch_units')->default(0);
            $table->unsignedBigInteger('dinner_units')->default(0);
            $table->unsignedBigInteger('fruit_units')->default(0);
            $table->unsignedBigInteger('snack_units')->default(0);
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
        Schema::dropIfExists('meal_breakdowns');
    }
}

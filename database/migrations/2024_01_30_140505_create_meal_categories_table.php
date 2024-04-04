<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->comment('breakfast', 'lunch', 'dinner')->nullable(); // Assuming const_diet_types is an enum
            $table->string('title')->comment('Breakfast', 'Lunch', 'Dinner')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('meal_categories');
    }
}

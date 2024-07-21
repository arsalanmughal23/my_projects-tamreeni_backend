<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeMealCategoryPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_meal_category_pivots', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');

            $table->unsignedBigInteger('nutrition_plan_day_recipe_id')->nullable();
            $table->foreign('nutrition_plan_day_recipe_id')->references('id')->on('nutrition_plan_day_recipes')->onDelete('cascade');

            $table->unsignedInteger('meal_category_id'); // 'Veggies', 'Shrimp', 'Sea Food', 'Fish', 'Eggs', 'Dairy'
            $table->foreign('meal_category_id')->references('id')->on('meal_categories')->onDelete('cascade');

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
        Schema::table('recipe_meal_category_pivots', function (Blueprint $table) {
            $table->dropForeign(['recipe_id']);
            $table->dropForeign(['nutrition_plan_day_recipe_id']);
            $table->dropForeign(['meal_category_id']);
        });

        Schema::dropIfExists('recipe_meal_category_pivots');
    }
}

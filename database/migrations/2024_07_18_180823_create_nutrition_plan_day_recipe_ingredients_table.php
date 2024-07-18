<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanDayRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_plan_day_recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->enum('type', ['main', 'sub']);
            $table->text('name');
            $table->bigInteger('quantity');
            $table->enum('unit', ['tsp', 'tbsp', 'fl oz', 'cup', 'pt', 'qt', 'gal', 'ml', 'l', 'oz', 'lb', 'g', 'kg']);
            $table->bigInteger('scaled_quantity');
            $table->enum('scaled_unit', ['tsp', 'tbsp', 'fl oz', 'cup', 'pt', 'qt', 'gal', 'ml', 'l', 'oz', 'lb', 'g', 'kg']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('nutrition_plan_day_recipe_ingredients')){
            Schema::table('nutrition_plan_day_recipe_ingredients', function (Blueprint $table) {
                $table->dropForeign(['recipe_id']);
            });
        }

        Schema::dropIfExists('nutrition_plan_day_recipe_ingredients');
    }
}

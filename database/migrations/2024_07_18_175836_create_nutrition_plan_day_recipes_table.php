<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanDayRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_plan_day_recipes', function (Blueprint $table) {
            $table->id();
            $table->enum('diet_type', ['traditional', 'keto']);
            
            $table->unsignedBigInteger('nutrition_plan_day_id');
            $table->unsignedBigInteger('meal_type_id'); // 'Breakfast', 'Lunch', 'Dinner', 'Fruit', 'Snack'
            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->json('meal_category_ids');

            $table->text('title');
            $table->longText('description');
            $table->text('image')->nullable();
            $table->longText('instruction');
            $table->bigInteger('units_in_recipe');
            $table->bigInteger('divide_recipe_by');
            $table->bigInteger('number_of_units')->default(1);

            $table->bigInteger('calories')->default(0);
            $table->double('carbs', 8, 2)->default(0);
            $table->double('fats', 8, 2)->default(0);
            $table->double('protein', 8, 2)->default(0);

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('nutrition_plan_day_id')->references('id')->on('nutrition_plan_days')->onDelete('cascade');
            $table->foreign('meal_type_id')->references('id')->on('meal_types')->onDelete('cascade');
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
        Schema::table('nutrition_plan_day_recipes', function (Blueprint $table) {
            $table->dropForeign(['nutrition_plan_day_id']);
            $table->dropForeign(['recipe_id']);
            $table->dropForeign(['meal_type_id']);
        });

        Schema::dropIfExists('nutrition_plan_day_recipes');
    }
}

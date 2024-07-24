<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNplanDayRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nplan_day_recipe_ingredients')) {
            Schema::create('nplan_day_recipe_ingredients', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('nplan_day_recipe_id');
                $table->enum('type', ['main', 'sub']);
                $table->text('name');
                $table->bigInteger('quantity');
                $table->enum('unit', ['tsp', 'tbsp', 'fl oz', 'cup', 'pt', 'qt', 'gal', 'ml', 'l', 'oz', 'lb', 'g', 'kg']);
                $table->bigInteger('scaled_quantity');
                $table->enum('scaled_unit', ['tsp', 'tbsp', 'fl oz', 'cup', 'pt', 'qt', 'gal', 'ml', 'l', 'oz', 'lb', 'g', 'kg']);
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('nplan_day_recipe_id')->references('id')->on('nutrition_plan_day_recipes')->onDelete('cascade');
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
        if(Schema::hasTable('nplan_day_recipe_ingredients')){
            Schema::table('nplan_day_recipe_ingredients', function (Blueprint $table) {
                $table->dropForeign(['nplan_day_recipe_id']);
            });
        }

        Schema::dropIfExists('nplan_day_recipe_ingredients');
    }
}

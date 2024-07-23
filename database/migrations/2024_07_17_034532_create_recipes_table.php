<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {            
            $table->id();
            $table->enum('diet_type', ['traditional', 'keto']);

            $table->unsignedBigInteger('meal_type_id'); // 'breakfast', 'lunch', 'dinner', 'fruit', 'snack'
            $table->json('meal_category_ids'); // 'veggies', 'shrimp', 'sea_food', 'fish', 'eggs', 'dairy'

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

            $table->foreign('meal_type_id')->references('id')->on('meal_types')->onDelete('cascade');
            // $table->unique(['diet_type', 'calories']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign(['meal_type_id']);
            // $table->dropUnique(['diet_type', 'calories']);
        });

        Schema::dropIfExists('recipes');
    }

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe', function (Blueprint $table) {
            $table->id();
            $table->enum('diet_type', ['traditional', 'keto']);
            $table->string('title');
            $table->longText('description');
            $table->text('image');
            $table->longText('instruction');
            $table->bigInteger('units_in_recipe');
            $table->bigInteger('divide_recipe_by');
            $table->bigInteger('number_of_units');

            $table->float('calories')->nullable();
            $table->double('carbs', 8, 2)->default(0);
            $table->double('fats', 8, 2)->default(0);
            $table->double('protein', 8, 2)->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['diet_type', 'calories']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe', function (Blueprint $table) {
            $table->dropUnique(['diet_type', 'calories']);
        });

        Schema::dropIfExists('recipe');
    }
}

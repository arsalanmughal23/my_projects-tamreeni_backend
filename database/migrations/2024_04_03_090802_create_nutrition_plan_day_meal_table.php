<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanDayMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_plan_day_meals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nutrition_plan_day_id');
            $table->foreign('nutrition_plan_day_id')->references('id')->on('nutrition_plan_days')->onDelete('cascade');
            $table->unsignedInteger('meal_id')->nullable();
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->integer('meal_category_id')->unsigned();
            $table->foreign('meal_category_id')->references('id')->on('meal_categories')->onDelete('cascade');
            $table->string('name')->nullable(false);
            $table->enum('diet_type', ['traditional', 'keto'])->nullable();
            $table->double('calories', 8, 2)->default(0)->nullable(false);
            $table->double('carbs', 8, 2)->default(0)->nullable(false);
            $table->double('fats', 8, 2)->default(0)->nullable(false);
            $table->double('protein', 8, 2)->default(0)->nullable(false);
            $table->integer('status')->nullable(false);
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
        Schema::table('nutrition_plan_day_meals', function (Blueprint $table) {
            //
        });
    }
}

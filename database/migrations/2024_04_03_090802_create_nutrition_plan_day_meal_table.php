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
            $table->unsignedInteger('meal_id')->nullable();
            $table->bigInteger('meal_type_id')->unsigned();
            $table->unsignedInteger('meal_category_id'); //'breakfast', 'lunch', 'dinner'

            $table->text('name');
            $table->text('description')->nullable();
            $table->string('diet_type')->comment('traditional', 'keto');
            $table->string('image')->nullable();

            $table->double('calories', 8, 2)->default(0)->nullable(false);
            $table->double('carbs', 8, 2)->default(0)->nullable(false);
            $table->double('fats', 8, 2)->default(0)->nullable(false);
            $table->double('protein', 8, 2)->default(0)->nullable(false);
            $table->integer('status')->nullable(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('nutrition_plan_day_id')->references('id')->on('nutrition_plan_days')->onDelete('cascade');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('meal_category_id')->references('id')->on('meal_categories')->onDelete('cascade');
            $table->foreign('meal_type_id')->references('id')->on('meal_types')->onDelete('cascade');
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
            $table->dropConstrainedForeignId('nutrition_plan_day_id');
            $table->dropConstrainedForeignId('meal_id');
            $table->dropConstrainedForeignId('meal_type_id');
        });
    }
}

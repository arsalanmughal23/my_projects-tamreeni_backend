<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('diet_type')->comment('traditional', 'keto');
            $table->unsignedInteger('meal_category_id'); //'breakfast', 'lunch', 'dinner'
            $table->foreign('meal_category_id')->references('id')->on('meal_categories')->onDelete('cascade');

            $table->unsignedBigInteger('meal_type_id');
            $table->foreign('meal_type_id')->references('id')->on('meal_types')->onDelete('cascade');

            $table->text('name');
            $table->string('image')->nullable();
            $table->float('calories')->nullable();

            $table->double('carbs', 8, 2)->default(0);
            $table->double('fats', 8, 2)->default(0);
            $table->double('protein', 8, 2)->default(0);

            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
        Schema::table('meals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('meal_category_id');
            $table->dropConstrainedForeignId('meal_type_id');
        });
        Schema::dropIfExists('meals');
    }
}

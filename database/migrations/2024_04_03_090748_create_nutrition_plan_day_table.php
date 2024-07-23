<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_plan_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nutrition_plan_id');
            $table->foreign('nutrition_plan_id')->references('id')->on('nutrition_plans')->onDelete('cascade');
            $table->string('name', 255)->nullable(false);
            $table->date('date')->nullable(false);
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
        Schema::table('nutrition_plan_days', function (Blueprint $table) {
            $table->dropForeign(['nutrition_plan_id']);
        });

        Schema::dropIfExists('nutrition_plan_days');
    }
}

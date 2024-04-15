<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('welcome_title');
            $table->string('url');
            $table->string('logo');
            $table->string('email');
            $table->string('contact_number');
            $table->string('language');

            $table->decimal('service_fee', 8, 2, true);
            $table->decimal('coach_fee', 8, 2, true);
            $table->decimal('dietitian_fee', 8, 2, true);
            $table->decimal('therapist_fee', 8, 2, true);

            $table->softDeletes();
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
        Schema::dropIfExists('settings');
    }
}

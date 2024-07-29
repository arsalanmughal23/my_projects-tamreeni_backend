<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_durations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id');
            $table->text('title');
            $table->unsignedBigInteger('duration_in_month');
            $table->decimal('price', 8, 2, true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_durations');
    }
}

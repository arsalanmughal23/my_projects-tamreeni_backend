<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_memberships', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('membership_id');
            $table->unsignedBigInteger('membership_duration_id');
            $table->unsignedBigInteger('duration_in_month');
            $table->unsignedBigInteger('promo_code_id')->nullable();
            $table->string('promo_code')->nullable();
            $table->decimal('original_price', 8, 2, true);
            $table->decimal('discount', 8, 2, true)->nullable();
            $table->decimal('charge_amount', 8, 2, true);
            $table->timestamp('expire_at')->nullable();
            $table->enum('status', ['hold', 'active', 'inactive', 'reject'])->default('hold');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('promo_code_id')->references('id')->on('promo_codes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade');
            $table->foreign('membership_duration_id')->references('id')->on('membership_durations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_memberships');
    }
}

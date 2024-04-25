<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->nullableMorphs('transactionable');
            $table->string('payment_intent_id')->nullable();
            $table->string('payment_charge_id')->nullable();
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->string('currency', 191)->default("SAR");
            $table->float('amount')->default(0);
            $table->string('status', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

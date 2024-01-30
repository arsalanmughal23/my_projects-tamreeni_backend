<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('password');
            $table->enum('status', ['pending', 'active', 'in-active'])->default('pending'); // CONSTANT: pending, active, in-active

            $table->rememberToken();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('dob')->nullable();
            $table->string('image')->nullable();

            $table->boolean('email_verified_at')->nullable()->default(0)->comment('0,1');
            $table->tinyInteger('is_social_login')->default(0)->comment('0,1');

            $table->enum('gender', ['male', 'female'])->nullable()->comment('male, female'); // CONSTANT: male, female

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('device_type')->comment('ios, android, web');
            $table->string('device_token');
            $table->tinyInteger('push_notification')->default(0)->comment('0,1');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('user_social_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('platform');
            $table->string('client_id');
            $table->text('token');
            $table->timestamp('expires_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0,1');

            $table->softDeletes();
            $table->timestamps();

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

        if(Schema::hasTable('user_details')){
            Schema::table('user_details', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        
        if(Schema::hasTable('user_devices')){
            Schema::table('user_devices', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        
        if(Schema::hasTable('user_social_accounts')){
            Schema::table('user_social_accounts', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        Schema::dropIfExists('user_social_accounts');
        Schema::dropIfExists('user_devices');
        Schema::dropIfExists('user_details');
        Schema::dropIfExists('users');
    }
}

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
            $table->string('user_type')->nullable(); //admin - superadmin - client - driver - provider...
            $table->string('ip')->nullable();
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->unique();
            $table->float('age')->unsigned()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_ban')->default(false)->nullable();
            $table->text('ban_reason')->nullable();
            $table->boolean('is_activated_by_admin')->default(false);
            $table->string('reset_code')->nullable();
            $table->string('verified_code')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable();
            $table->float('rate_avg', 5, 2)->default(0);

            $table->string('referral_code')->nullable();

            $table->integer('register_complete_step')->default(1);
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}

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
            $table->string('screen_name')->nullable();
            $table->string('name');
            $table->string('profile_image_url')->nullable();
            $table->string('location')->nullable();
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at');
            $table->string('followers_count')->nullable();
            $table->string('friends_count')->nullable();
            $table->string('statuses_counts')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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

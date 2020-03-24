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
            $table->string('screen_name');
            $table->string('name');
            $table->string('profile_image_url');
            $table->string('location');
            $table->string('url');
            $table->string('description');
            $table->timestamp('created_at');
            $table->string('followers_count');
            $table->string('friends_count');
            $table->string('statuses_counts');
            $table->string('timezone');
            $table->timestamp('last_update');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string('tweet_text')->nullable();
            $table->string('entities')->nullable();
            $table->timestamp('create_at')->nullable();
            $table->string('geo_lat')->nullable();
            $table->string('geo_long')->nullable();
            $table->string('screen_name')->nullable();
            $table->string('name')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->foreignId('user_id');
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
        Schema::dropIfExists('tweets');
    }
}

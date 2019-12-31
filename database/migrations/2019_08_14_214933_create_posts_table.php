<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->integer('user_id')->unsigned();
            $table->integer('hero_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('location_id')->unsigned()->nullable();

            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->onDelete('cascade');
            $table->foreign('hero_id')->on('heroes')->onDelete('cascade');
            $table->foreign('place_id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

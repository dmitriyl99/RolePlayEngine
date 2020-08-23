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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hero_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hero_id')->references('id')->on('heroes')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}

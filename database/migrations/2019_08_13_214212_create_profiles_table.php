<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('date_of_birth');
            $table->string('place_of_birth');
            $table->string('nickname')->nullable();
            $table->string('appearance');
            $table->string('skills');
            $table->string('character');
            $table->string('start_equipment');
            $table->string('biography');
            $table->string('perimeter_intersection')->nullable();
            $table->string('test_post');
            $table->integer('hero_id')->unsigned();
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
        Schema::dropIfExists('profiles');
    }
}

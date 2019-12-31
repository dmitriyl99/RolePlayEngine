<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('gave_by')->nullable();
            $table->date('gave_at')->nullable();
            $table->string('period')->nullable();
            $table->boolean('done')->default(false);
            $table->integer('hero_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('quests', function (Blueprint $table) {
            $table->foreign('hero_id')->on('heroes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quests');
    }
}

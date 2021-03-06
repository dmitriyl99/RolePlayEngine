<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentTextMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('content')->change();
        });
        Schema::table('pdas', function (Blueprint $table) {
            $table->text('content')->change();
        });
        Schema::table('places', function (Blueprint $table) {
            $table->text('description')->change();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->text('content')->change();
        });
        Schema::table('profile_corrections', function (Blueprint $table) {
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtisansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artisans', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('art_fname')->nullable();
            $table->string('art_lname');
            $table->string('art_user');
            $table->string('art_email');
            $table->string('art_phone');
            $table->string('art_gender');
            $table->string('art_age');
            $table->string('category');
            $table->string('art_address');
            $table->string('art_about');
            $table->string('password');
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
        Schema::dropIfExists('artisans');
    }
}

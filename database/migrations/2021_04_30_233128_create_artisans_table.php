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
            $table->uuid('id')->unique();
            $table->string('art_fname')->nullable();
            $table->string('art_lname')->nullable();
            $table->string('art_user')->nullable();
            $table->string('art_email')->nullable();
            $table->string('art_phone')->nullable();
            $table->string('art_gender')->nullable();
            $table->string('art_age')->nullable();
            $table->string('category')->nullable();
            $table->string('art_address')->nullable();
            $table->string('art_about')->nullable();
            $table->string('password')->nullable();
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

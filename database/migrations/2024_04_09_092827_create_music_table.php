<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('music_title');
            $table->string('misuc_artist');
            $table->string('music_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('music');
    }
}

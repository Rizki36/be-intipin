<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoligonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poligon', function (Blueprint $table) {
            $table->id();
            $table->integer('lat');
            $table->integer('lng');
            $table->string('id_kecamatan');
            $table->string('id_kelurahan');
            $table->timestamps();

            $table->foreign('id_kecamatan')->references('id')->on('kecamatan');
            $table->foreign('id_kelurahan')->references('id')->on('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poligon');
    }
}

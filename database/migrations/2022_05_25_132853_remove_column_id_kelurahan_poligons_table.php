<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnIdKelurahanPoligonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poligon', function (Blueprint $table) {
            $table->dropForeign(['id_kelurahan']);
            $table->dropColumn('id_kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poligon', function (Blueprint $table) {
            $table->string('id_kelurahan');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
        });
    }
}

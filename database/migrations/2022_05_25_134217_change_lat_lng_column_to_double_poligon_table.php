<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLatLngColumnToDoublePoligonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poligon', function (Blueprint $table) {
            $table->decimal('lat', 20, 14)->change();
            $table->decimal('lng', 20, 14)->change();
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
            $table->integer('lat')->change();
            $table->integer('lng')->change();
        });
    }
}

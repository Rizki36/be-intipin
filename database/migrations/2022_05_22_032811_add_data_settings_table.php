<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDataSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            ['name' => 'description_1', 'value' => ''],
            ['name' => 'description_2', 'value' => ''],
            ['name' => 'image_1', 'value' => ''],
            ['name' => 'image_2', 'value' => ''],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')
            ->whereIn('name', [
                'description_1', 'description_2',
                'image_1', 'image_2'
            ])
            ->delete();
    }
}

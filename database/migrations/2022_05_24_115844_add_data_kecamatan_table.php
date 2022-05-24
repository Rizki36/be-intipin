<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDataKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('kecamatan')->insert([
            ['id' => '351701', 'nama' => 'Perak'],
            ['id' => '351702', 'nama' => 'Gudo'],
            ['id' => '351703', 'nama' => 'Ngoro'],
            ['id' => '351704', 'nama' => 'Bareng'],
            ['id' => '351705', 'nama' => 'Wonosalam'],
            ['id' => '351706', 'nama' => 'Mojoagung'],
            ['id' => '351707', 'nama' => 'Mojowarno'],
            ['id' => '351708', 'nama' => 'Diwek'],
            ['id' => '351709', 'nama' => 'Jombang'],
            ['id' => '351710', 'nama' => 'Peterongan'],
            ['id' => '351711', 'nama' => 'Sumobito'],
            ['id' => '351712', 'nama' => 'Kesamben'],
            ['id' => '351713', 'nama' => 'Tembelang'],
            ['id' => '351714', 'nama' => 'Ploso'],
            ['id' => '351715', 'nama' => 'Plandaan'],
            ['id' => '351716', 'nama' => 'Kabuh'],
            ['id' => '351717', 'nama' => 'Kudu'],
            ['id' => '351718', 'nama' => 'Bandarkedungmulyo (Bandar Kedung Mulyo)'],
            ['id' => '351719', 'nama' => 'Jogoroto'],
            ['id' => '351720', 'nama' => 'Megaluh'],
            ['id' => '351721', 'nama' => 'Ngusikan']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // delete data by ids
        DB::table('kecamatan')
            ->whereIn('id', [
                '351701',
                '351702',
                '351703',
                '351704',
                '351705',
                '351706',
                '351707',
                '351708',
                '351709',
                '351710',
                '351711',
                '351712',
                '351713',
                '351714',
                '351715',
                '351716',
                '351717',
                '351718',
                '351719',
                '351720',
                '351721'
            ])
            ->delete();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TipoPrestadorSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipos = array(
            array('tipo'=>'OBRA SOCIAL'),
            array('tipo'=>'SEGURO'),
            array('tipo'=>'ART'),
        );

        DB::table('tipos_prestadores')->insert($tipos);
    }
}

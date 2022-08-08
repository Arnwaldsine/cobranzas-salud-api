<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RespuestaSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $respuestas = array(
            array('respuesta'=>'NO ATIENDE'),
            array('respuesta'=>'TEL EQUIVOCADO'),
            array('respuesta'=>'PROMESA DE PAGO'),
            array('respuesta'=>'NO PAGARA'),
            array('respuesta'=>'EN CONTADURIA'),
            array('respuesta'=>'EN TESORERIA'),
            array('respuesta'=>'CHEQUE A LA FIRMA'),
            array('respuesta'=>'OTRO'),
            array('respuesta'=>'RECLAMO SSS')
        );
        DB::table('respuestas')->insert($respuestas);
    }
}

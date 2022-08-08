<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class EstadoSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadoInsert=[];
        $estados = [
            'ARCHIVADO SIN COBRAR',
            'COBRADA',
            'DEBITO PARCIAL',
            'FACTURA ANULADA',
            'PAGO PARCIAL',
            'PROMESA DE PAGO',
            'RECLAMO SUPER',
            'VALOR A RETIRAR',
            'NOTA CREDITO'
        ];

        foreach($estados as $e){
            $estadosInsert[] =[
                'estado' => $e,
            ];
        }
        DB::table('estados')->insert($estadosInsert);
    }
}

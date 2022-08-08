<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FacturaSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $facturas= [];
        foreach(range(1,120) as $index){
            $facturas[]=[
                'obra_social_id' => random_int(1,7),
                'punto_venta_id' => random_int(1,14),
                'fecha_emision'=>now(),
                'fecha_ultimo_pago'=>null,
                'fecha_acuse'=>now(),
                'importe'=>random_int(100000,650000)/100,
                'cobrado'=>0,
                'estado_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
                'observaciones'=> $faker->text(100),
            ];
        }
        DB::table('facturas')->insert($facturas);
    }
}

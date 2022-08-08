<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class PuntoVentaSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $puntos_venta = [];

        $faker = Faker::create();

        foreach(range(1,14) as $index){
            $puntos_venta[]=[
                'numero'=> $index+12,
                'nombre'=> $faker->lastName(),
            ];
        }
        DB::table('puntos_venta')->insert($puntos_venta);
    }
}

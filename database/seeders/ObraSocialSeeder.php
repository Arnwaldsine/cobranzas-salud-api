<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ObraSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obrasSociales = [];

        $faker = Faker::create();

        foreach(range(1,8) as $index){
            $obrasSociales[] = [
                'rnos' => $faker->numerify('######'),
                'nombre' => $faker->unique()->company(),
                'cuit'=> $faker->numerify('##-########-#'),
                'telefono' => $faker->numerify('4#######'),
                'direccion'=> $faker->address(),
                'cp'=>$faker->numerify('####'),
                'pagina'=>$faker->url(),
                'horario_admin'=>random_int(8,11).'-'.random_int(14,18) ,
                'contacto_admin'=> $faker->name(),
                'tel_admin'=>"interno ".$faker->numerify('###'),
                'contacto_geren_1'=>$faker->name(),
                'contacto_geren_2'=>$faker->name(),
                'tel_gere'=>"interno ".$faker->numerify('###'),
                'mail_geren'=>$faker->email(),
                'observaciones'=>$faker->realText(100,2),
                'tipo_prestador_id'=> random_int(1,3),
            ];

        }
        DB::table('obras_sociales')->insert($obrasSociales);
    }
}

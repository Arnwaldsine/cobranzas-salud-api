<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class GestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $gestiones = [];
        foreach(range(1,10) as $index){
            $gestiones[]=[
                'obra_social_id'=> random_int(1,8),
                'contacto_id'=>random_int(1,6),
                'fecha_contacto'=>now(),
                'respuesta_id'=>random_int(1,9),
                'fecha_proximo_contacto'=>now()->addDays(5),
                'user_id'=>1,
                'observaciones'=>$faker->text(20),
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }
        DB::table('gestiones')->insert($gestiones);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bancos = [];
        /* foreach(range(1,10) as $index){
             $bancos[]=[
             'nombre' => $name = "Banco $index",
             'created_at' => now(),
             'updated_at'=> now(),
             ];
         }
         DB::table('bancos')->insert($bancos);*/
         $faker = Faker::create();
         foreach(range(1,5) as $index){

             $bancos[] = [
                 'nombre' => $faker->company(),
                 'created_at' => now(),
                 'updated_at'=> now(),
             ];
         }
         DB::table('bancos')->insert($bancos);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users=[];
        foreach(range(1,10) as $index){
            $users[]=[
                'nombre'=>$faker->firstName(),
                'apellido'=>$faker->lastName(),
                'bio'=> $faker->text(20),
                'email'=>$faker->email(),
                'password'=>Hash::make('Franco2310!'),
                'created_at'=>now(),
                'updated_at'=>now(),
                'punto_venta_id'=>random_int(1,14)
            ];
        }
        DB::table('users')->insert($users);

    }
}

<?php

namespace Database\Seeders;

use App\Models\Recibo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ReciboSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $faker = Faker::create();
        foreach(range(1,5) as $index){
            $recibo = new Recibo();
            $recibo->total = 0;
            $recibo->observaciones = $faker->text(20);
            $recibo->punto_venta_id = random_int(1,5);
            $recibo->created_at = now();
            $recibo->updated_at = now();
            $recibo->save();
            $a = random_int(1,100);
            foreach(range(0,2) as $index){
                $recibo->facturas()->attach(random_int(1,100),[
                'recibo_id'=> $recibo->id,
                'forma_pago_id' => random_int(1,3),
                'nro_cheque_transf'=>$faker->numerify('####-#######-###'),
                'nro_recibo_tesoreria' =>$faker->numerify('####-#######-###'),
                'banco_id' => random_int(1,5),
                'subtotal'=>$faker->randomFloat(2,0,10000),]);
            }
            $recibo->total = $recibo->facturas->sum('pivot.subtotal');
            $recibo->save();
        }
*/
    }
}

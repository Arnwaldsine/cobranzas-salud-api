<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaPagoSeeder extends Seeder
{
  /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $formasPago = array(
            array('forma'=>'EFECTIVO'),
            array('forma'=>'CHEQUE',),
            array('forma'=>'TRANSFERENCIA')
        );
        DB::table('formas_pago')->insert($formasPago);
    }
}

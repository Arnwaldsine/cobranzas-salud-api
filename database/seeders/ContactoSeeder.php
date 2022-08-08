<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactos = array(
            array('contacto'=>'CONTADOR'),
            array('contacto'=>'ADMINISTRACION'),
            array('contacto'=>'JEFE'),
            array('contacto'=>'GERENTE'),
            array('contacto'=>'OTRO'),
            array('contacto'=>'AUDITOR')
        );
        DB::table('contactos')->insert($contactos);
    }
}

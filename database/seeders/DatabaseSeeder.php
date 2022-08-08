<?php

namespace Database\Seeders;

use App\Models\Recibo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BancoSeeder::class);
        $this->call(ContactoSeeder::class);
        $this->call(RespuestaSeeder::class);
        $this->call(PuntoVentaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(FormaPagoSeeder::class);
        $this->call(TipoPrestadorSeeder::class);
        $this->call(ObraSocialSeeder::class);
        $this->call(FacturaSeeder::class);
        $this->call(GestionSeeder::class);

        $this->call(ReciboSeeder::class);
    }
}

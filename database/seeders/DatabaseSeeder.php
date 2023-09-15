<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create ();

        $this->call(UsersSeeder::class);

        $this->call(CoberturaSeeder::class);
        $this->call(TipoPolizaSeeder::class);
        $this->call(PolizaSeeder::class);
        $this->call(TipoSiniestroSeeder::class);
        $this->call(ReclamoSeeder::class);
        $this->call(SiniestroSeeder::class);

        $this->call(PolizaCoberturaSeeder::class);

        $this->call(ReclamoPolizaSeeder::class);
        $this->call(SiniestroUsuarioSeeder::class);
        $this->call(Cobertura_tipo_SiniestroSeeder::class);
        $this->call(Tipo_Poliza_CoberturaSeeder::class);
        $this->call(PolizaUsuariosSeeder::class);








    }
}
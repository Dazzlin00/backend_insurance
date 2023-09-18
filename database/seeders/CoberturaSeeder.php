<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoberturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            
            [
                'descripcion' => 'Cobertura de colisión',
                'monto_cobertura' => 500,
            ],
           
            [
                'descripcion' => 'Cobertura por Atención médica',
                'monto_cobertura' => 600,
            ],
            [
                'descripcion' => 'Cobertura por Incendio',
                'monto_cobertura' => 700,
            ],
        ];

        DB::table('coberturas')->insert($data);
    }
}
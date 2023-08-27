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
                'descripcion' => 'Cobertura por daños a la propiedad',
                'monto_cobertura' => 500000,
            ],
            [
                'descripcion' => 'Cobertura por fraude',
                'monto_cobertura' => 400000,
            ],
            [
                'descripcion' => 'Cobertura por ciberseguridad',
                'monto_cobertura' => 500000,
            ],
        ];

        DB::table('coberturas')->insert($data);
    }
}
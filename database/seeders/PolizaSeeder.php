<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolizaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            'id_usuario'=>'2',
            'num_poliza'=>'1234567890',
            'tipo_poliza'=>'1',
            'fecha_inicio'=>'2023-08-26',
            'fecha_vencimiento'=>'2024-08-25',
            'cobertura'=>'1',
            'monto_prima'=>'10000',
            'estado'=>'Activa',
        ];
        DB::table('polizas')->insert($data);
        
    }
}

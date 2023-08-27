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
            'fecha_inicio'=>'2023-08-26',
            'fecha_vencimiento'=>'2024-08-25',
            'monto_prima'=>'10000',
            'estado'=>'activa',
        ];
        DB::table('polizas')->insert($data);
        
    }
}

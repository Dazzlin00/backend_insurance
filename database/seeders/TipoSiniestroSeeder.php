<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            [
                'descripcion'=>'Accidente automovilístico'
            ],
           
            [
                'descripcion'=>'Enfermedades'
            ],
            [
                'descripcion'=>'Incendio'
            ],
        ];
        DB::table('tipo_siniestros')->insert($data);
    }
}

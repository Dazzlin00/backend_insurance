<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            'id_tipo_siniestro'=>'1',
            'id_poliza'=>'1',
            'id_usuario'=>'2',
            'fecha_reporte'=>'2023-08-26',
            'fecha_declaracion'=>'2023-08-26',
            'estado_ocu'=>'Lara',
            'ciudad'=>'Barquisimeto',
            'lugar'=>'el cuji',

            'descripcion'=>'Un vehículo de la empresa XYZ colisionó con otro vehículo en la ciudad de Barquisimeto.',
            'estado'=>'activa',
        ];
        DB::table('siniestros')->insert($data);
    }
}

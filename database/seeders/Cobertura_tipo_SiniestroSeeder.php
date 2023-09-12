<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Cobertura_tipo_SiniestroSeeder extends Seeder
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
                'id_cobertura' => '1',
                'id_tipo_siniestro' => '1',
            ],
            [
                'id_cobertura' => '2',
                'id_tipo_siniestro' => '2',
            ],
            [
                'id_cobertura' => '3',
                'id_tipo_siniestro' =>'3',
            ],
        ];

        DB::table('cobertura_siniestros')->insert($data);
    }
}

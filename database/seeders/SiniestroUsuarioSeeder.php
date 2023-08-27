<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiniestroUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            'id_siniestro'=>'1',
            'id_usuario'=>'2',
            
        ];
        DB::table('siniestro_usuarios')->insert($data);
    }
}

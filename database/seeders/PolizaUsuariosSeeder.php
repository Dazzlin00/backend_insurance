<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolizaUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            'id_poliza'=>'1',
            'id_usuario'=>'2',
            
        ];
        DB::table('poliza__usuarios')->insert($data);
 
    }
}

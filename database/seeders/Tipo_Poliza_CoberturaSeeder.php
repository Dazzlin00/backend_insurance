<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tipo_Poliza_CoberturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            [ 'id_tipo_poliza'=>'1',
            'id_cobertura'=>'1',
            
             ],
             [ 'id_tipo_poliza'=>'2',
            'id_cobertura'=>'2',
            
             ],
             [ 'id_tipo_poliza'=>'3',
             'id_cobertura'=>'3',
             
              ],
    
    ];
        DB::table('tipo_poliza__coberturas')->insert($data);
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolizaCoberturaSeeder extends Seeder
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
            'id_corbertura'=>'1',
            
        ];
        DB::table('poliza_coberturas')->insert($data);
        
    }
}

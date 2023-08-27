<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReclamoPolizaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            
                'id_reclamo' => '1',
                'id_poliza' => '1',
            
        ];
        DB::table('reclamo_polizas')->insert($data);
        
    }
}

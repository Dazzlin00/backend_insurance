<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReclamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [ 
            
                'numero_reclamo' => '9876543210',
                'fecha_reclamo' => now(),
                'descripcion' => 'Choque de coche',
            
        ];
        DB::table('reclamos')->insert($data);
        
    }
}

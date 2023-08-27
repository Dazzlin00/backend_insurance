<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza_Cobertura extends Model
{
    use HasFactory;
            protected $fillable= ['id_poliza','id_corbertura'];

}

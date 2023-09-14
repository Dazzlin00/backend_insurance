<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPoliza_Cobertura extends Model
{
    use HasFactory;

    protected $fillable= ['id_tipo_poliza','id_cobertura'];

}

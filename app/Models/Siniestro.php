<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    use HasFactory;
    protected $fillable= ['id_tipo_siniestro','numero_siniestro','fecha_reporte','descripcion','estado'];

}

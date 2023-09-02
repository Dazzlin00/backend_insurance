<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['id_usuario','num_poliza','tipo_poliza','fecha_inicio','fecha_vencimiento','cobertura','monto_prima','estado'];
}

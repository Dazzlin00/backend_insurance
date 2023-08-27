<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    use HasFactory;

    protected $fillable= ['id_usuario','num_poliza','fecha_inicio','fecha_vencimiento','monto_prima','estado'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pago extends Model
{
    use HasFactory;
    protected $fillable= ['id_poliza','numero_transaccion','monto','fecha_pago','descripcion','estado'];

    protected static $estadoValues = [
        'En espera',
        'Rechazado',
        'Pagado'
    ];

    public function setEstadoAttribute($value)
    {
        // Verificar si el valor está dentro de los posibles valores
        if (in_array($value, self::$estadoValues)) {
            $this->attributes['estado'] = $value;
        } else {
            $this->attributes['estado'] = "En espera";
            return false;
        }
    }

    public static function getEstadoValues()
    {
        return self::$estadoValues;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}

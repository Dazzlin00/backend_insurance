<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    use HasFactory;
protected $fillable= ['descripcion','monto_cobertura'];
public $timestamps = false;
public function polizas()
{
    return $this->belongsToMany(Poliza::class, 'poliza_coberturas', 'id_cobertura','id_poliza');
}
}

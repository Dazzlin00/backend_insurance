<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPoliza extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion'];

    public function coberturas()
    {
        return $this->belongsToMany(Cobertura::class, 'tipo_poliza__coberturas', 'id_tipo_poliza', 'id_cobertura');
    }

}

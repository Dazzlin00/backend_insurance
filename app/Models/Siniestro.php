<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_tipo_siniestro', 'id_poliza','id_usuario', 'fecha_reporte' ,'fecha_declaracion','estado_ocu','ciudad','lugar','descripcion', 'estado'];
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'siniestro__usuarios', 'id_siniestro', 'id_usuario');
    }

   
}
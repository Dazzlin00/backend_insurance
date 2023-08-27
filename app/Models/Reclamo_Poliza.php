<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo_Poliza extends Model
{
    use HasFactory;
        protected $fillable= ['id_reclamo','id_poliza'];

}

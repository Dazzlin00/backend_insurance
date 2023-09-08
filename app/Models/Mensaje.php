<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
            protected $fillable= ['fecha', 'email', 'mensaje'];
            public $timestamps = false;

}
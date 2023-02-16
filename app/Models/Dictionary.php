<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "departamento",
        "localidad",
        "municipio",
        "nombre",
        "años_activo",
        "tipo_persona",
        "tipo cargo",
    ];

}

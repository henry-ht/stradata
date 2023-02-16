<?php

namespace App\Models;

use App\Helpers\Similarity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    protected static String $comparisonName;
    protected $appends = ['similarity'];

    public static function setComparisonName(String $name)
    {
        static::$comparisonName = ucwords($name);
    }

    public function getSimilarityAttribute(){
        if(!empty(static::$comparisonName)){
            return Similarity::get(static::$comparisonName, $this->nombre);
        }

        return null;
    }

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

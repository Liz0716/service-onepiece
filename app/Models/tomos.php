<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tomos extends Model
{
    use HasFactory;
    protected $table = "tomos";

    // Seleccionar la llave primaria de la tabla
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'numero_tomo',
        'titulo',
        'capitulos_incluidos',
        'fecha_publicacion',
        'portada',
        'sinopsis',
        'eliminado'
    ];

    // Cuando esta en hidden quiere decir que no se motrara
    protected $hidden = [
        'eliminado'
    ];

}

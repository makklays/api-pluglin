<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Idioma;

class Contenido extends Model
{
    use HasFactory;

    protected $table = 'contenido';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'categoria_id',
        'idioma_id',
        'name', 
        'body',
    ];

    public function idioma_one()
    {
        return $this->hasOne(Idioma::class, 'id', 'idioma_id');
    }

    public function categoria_one()
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }
}

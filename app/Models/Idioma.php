<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Idioma extends Model
{
    use HasFactory;

    protected $table = 'idiomas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'parent_id',
        'title',
        'name', 
        'description',
        'categoria_id',
        'data',
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_id', 'id');
    }

    /*public function categoria_one()
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }*/
}


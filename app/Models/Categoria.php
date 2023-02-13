<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Idioma;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'parent_id',
        'title',
        'name', 
        'description',
        'idioma_id',
        'data',
    ];

    public function idiomas()
    {
        return $this->hasMany(Idioma::class, 'idioma_id', 'id');
    }

    /*public function idioma_one()
    {
        return $this->hasOne(Idioma::class, 'id', 'idioma_id');
    }*/
}

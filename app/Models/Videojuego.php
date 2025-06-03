<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'anio', // Asegúrate de que aquí sea 'anio'
        'portada',
    ];

    public function plataformas()
    {
        // Laravel infiere la tabla pivot 'plataforma_videojuego' y las claves foráneas
        // 'videojuego_id' y 'plataforma_id' por convención.
        return $this->belongsToMany(Plataforma::class);
    }
}
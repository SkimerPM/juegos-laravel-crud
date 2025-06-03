<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function videojuegos()
    {
        // Laravel infiere la tabla pivot 'plataforma_videojuego' y las claves foráneas
        // 'plataforma_id' y 'videojuego_id' por convención.
        return $this->belongsToMany(Videojuego::class);
    }
}
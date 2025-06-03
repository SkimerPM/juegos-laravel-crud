<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use App\Models\Plataforma; // Necesitamos este modelo para las relaciones
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Para manejar la carga de archivos

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de todos los videojuegos.
     */
    public function index()
    {
        // Carga ansiosa las plataformas para evitar el problema N+1
        $videojuegos = Videojuego::with('plataformas')->orderBy('titulo')->paginate(10);
        return view('videojuegos.index', compact('videojuegos'));
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear un nuevo videojuego.
     */
    public function create()
    {
        $plataformas = Plataforma::all(); // Obtén todas las plataformas para el formulario
        return view('videojuegos.create', compact('plataformas'));
    }

    /**
     * Store a newly created resource in storage.
     * Guarda un nuevo videojuego en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1950|max:' . date('Y'), // Asegúrate que el 'anio' sea válido
            'portada' => 'nullable|image|max:2048', // Validación para la imagen (max 2MB)
            'plataformas' => 'nullable|array', // Las plataformas seleccionadas deben ser un array
            'plataformas.*' => 'exists:plataformas,id', // Cada ID de plataforma debe existir en la tabla 'plataformas'
        ]);

        $data = $request->except('portada'); // Obtén todos los datos excepto la portada inicialmente

        // Manejo de la carga de imagen
        if ($request->hasFile('portada')) {
            $path = $request->file('portada')->store('portadas', 'public'); // Guarda en storage/app/public/portadas
            $data['portada'] = $path;
        }

        $videojuego = Videojuego::create($data);

        // Adjuntar plataformas (relación Many-to-Many)
        if ($request->has('plataformas')) {
            $videojuego->plataformas()->attach($request->plataformas);
        }

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego creado exitosamente.');
    }

    /**
     * Display the specified resource.
     * Muestra los detalles de un videojuego específico.
     */
    public function show(Videojuego $videojuego)
    {
        // Carga ansiosa las plataformas para mostrar en el detalle
        $videojuego->load('plataformas');
        return view('videojuegos.show', compact('videojuego'));
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar un videojuego existente.
     */
    public function edit(Videojuego $videojuego)
    {
        $plataformas = Plataforma::all();
        // Obtiene los IDs de las plataformas ya asociadas a este videojuego
        $videojuegoPlataformasIds = $videojuego->plataformas->pluck('id')->toArray();
        return view('videojuegos.edit', compact('videojuego', 'plataformas', 'videojuegoPlataformasIds'));
    }

    /**
     * Update the specified resource in storage.
     * Actualiza un videojuego en la base de datos.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1950|max:' . date('Y'),
            'portada' => 'nullable|image|max:2048',
            'plataformas' => 'nullable|array',
            'plataformas.*' => 'exists:plataformas,id',
        ]);

        $data = $request->except('portada');

        // Manejo de la actualización de imagen
        if ($request->hasFile('portada')) {
            // Eliminar la portada antigua si existe
            if ($videojuego->portada) {
                Storage::disk('public')->delete($videojuego->portada);
            }
            $path = $request->file('portada')->store('portadas', 'public');
            $data['portada'] = $path;
        }

        $videojuego->update($data);

        // Sincronizar plataformas (adjunta nuevas, desadjunta las que ya no están)
        $videojuego->plataformas()->sync($request->plataformas);

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina un videojuego de la base de datos.
     */
    public function destroy(Videojuego $videojuego)
    {
        // Eliminar la imagen asociada si existe
        if ($videojuego->portada) {
            Storage::disk('public')->delete($videojuego->portada);
        }

        $videojuego->delete();
        return redirect()->route('videojuegos.index')->with('success', 'Videojuego eliminado exitosamente.');
    }
}
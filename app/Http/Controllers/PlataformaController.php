<?php

namespace App\Http\Controllers;

use App\Models\Plataforma;
use Illuminate\Http\Request;

class PlataformaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de todas las plataformas.
     */
    public function index()
    {
        $plataformas = Plataforma::orderBy('nombre')->paginate(10);
        return view('plataformas.index', compact('plataformas'));
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear una nueva plataforma.
     */
    public function create()
    {
        return view('plataformas.create');
    }

    /**
     * Store a newly created resource in storage.
     * Guarda una nueva plataforma en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:plataformas,nombre',
            'creador' => 'nullable|string|max:255',
        ]);

        Plataforma::create($request->all());

        return redirect()->route('plataformas.index')->with('success', 'Plataforma creada exitosamente.');
    }

    /**
     * Display the specified resource.
     * Muestra los detalles de una plataforma específica.
     */
    public function show(Plataforma $plataforma)
    {
        // En este caso, una plataforma también puede mostrar sus videojuegos asociados
        // Usamos loadCount para contar cuántos videojuegos tiene, y load para cargar los videojuegos
        $plataforma->loadCount('videojuegos');
        $plataforma->load('videojuegos'); // Carga los videojuegos asociados para mostrarlos
        return view('plataformas.show', compact('plataforma'));
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar una plataforma existente.
     */
    public function edit(Plataforma $plataforma)
    {
        return view('plataformas.edit', compact('plataforma'));
    }

    /**
     * Update the specified resource in storage.
     * Actualiza una plataforma en la base de datos.
     */
    public function update(Request $request, Plataforma $plataforma)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:plataformas,nombre,' . $plataforma->id,
            'creador' => 'nullable|string|max:255', // Nueva regla
        ]);

        $plataforma->update($request->all());

        return redirect()->route('plataformas.index')->with('success', 'Plataforma actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina una plataforma de la base de datos.
     */
    public function destroy(Plataforma $plataforma)
    {
        $plataforma->delete();
        return redirect()->route('plataformas.index')->with('success', 'Plataforma eliminada exitosamente.');
    }
}

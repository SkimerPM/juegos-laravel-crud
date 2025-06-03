@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Detalles de Plataforma: {{ $plataforma->nombre }}</h1>

        <p class="text-gray-700 mb-2"><strong class="font-semibold">ID:</strong> {{ $plataforma->id }}</p>
        <p class="text-gray-700 mb-2"><strong class="font-semibold">Nombre:</strong> {{ $plataforma->nombre }}</p>
        <p class="text-gray-700 mb-4"><strong class="font-semibold">Videojuegos asociados:</strong> {{ $plataforma->videojuegos_count }}</p>

        @if ($plataforma->videojuegos->isNotEmpty())
            <h2 class="text-xl font-bold text-gray-800 mt-6 mb-3">Videojuegos en esta Plataforma:</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach ($plataforma->videojuegos as $videojuego)
                    <li><a href="{{ route('videojuegos.show', $videojuego->id) }}" class="text-blue-600 hover:underline">{{ $videojuego->titulo }} ({{ $videojuego->anio }})</a></li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 mt-6">Esta plataforma no tiene videojuegos asociados aún.</p>
        @endif


        <div class="flex space-x-3 mt-6">
            <a href="{{ route('plataformas.edit', $plataforma->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg">
                Editar
            </a>
            <form action="{{ route('plataformas.destroy', $plataforma->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta plataforma?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                    Eliminar
                </button>
            </form>
            <a href="{{ route('plataformas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
                Volver al Listado
            </a>
        </div>
    </div>
@endsection
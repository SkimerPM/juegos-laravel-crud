@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $videojuego->titulo }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            <div>
                @if ($videojuego->portada)
                    <img src="{{ asset('storage/' . $videojuego->portada) }}" alt="{{ $videojuego->titulo }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg text-gray-500 text-lg">
                        Sin Portada
                    </div>
                @endif
            </div>
            <div>
                <p class="text-gray-700 mb-2"><strong class="font-semibold">Año de Lanzamiento:</strong> {{ $videojuego->anio }}</p>

                <p class="text-gray-700 mb-4">
                    <strong class="font-semibold">Plataformas:</strong>
                    @forelse ($videojuego->plataformas as $plataforma)
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded-full mr-2 mb-1">
                            {{ $plataforma->nombre }}
                        </span>
                    @empty
                        <span class="text-gray-500 text-sm">Ninguna</span>
                    @endforelse
                </p>

                <div class="flex space-x-3 mt-6">
                    <a href="{{ route('videojuegos.edit', $videojuego->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg">
                        Editar
                    </a>
                    <form action="{{ route('videojuegos.destroy', $videojuego->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este videojuego?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                            Eliminar
                        </button>
                    </form>
                    <a href="{{ route('videojuegos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
                        Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Videojuego: {{ $videojuego->titulo }}</h1>

        <form action="{{ route('videojuegos.update', $videojuego->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Importante para el método PUT/PATCH --}}
            @include('videojuegos._form', ['videojuego' => $videojuego, 'plataformas' => $plataformas, 'videojuegoPlataformasIds' => $videojuegoPlataformasIds])
        </form>
    </div>
@endsection
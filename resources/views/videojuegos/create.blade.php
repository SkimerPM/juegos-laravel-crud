@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nuevo Videojuego</h1>

        <form action="{{ route('videojuegos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('videojuegos._form')
        </form>
    </div>
@endsection
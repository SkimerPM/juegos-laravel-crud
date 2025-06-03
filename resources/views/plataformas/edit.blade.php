@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Plataforma: {{ $plataforma->nombre }}</h1>

        <form action="{{ route('plataformas.update', $plataforma->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('plataformas._form', ['plataforma' => $plataforma])
        </form>
    </div>
@endsection
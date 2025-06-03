@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nueva Plataforma</h1>

        <form action="{{ route('plataformas.store') }}" method="POST">
            @csrf
            @include('plataformas._form')
        </form>
    </div>
@endsection
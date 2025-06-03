<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Videojuegos</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    {{-- Barra de Navegación --}}
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-white text-xl font-bold">Gestión de Juegos</a>
            <div>
                <a href="{{ route('videojuegos.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Videojuegos</a>
                <a href="{{ route('plataformas.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Plataformas</a>
            </div>
        </div>
    </nav>
    {{-- Fin de Barra de Navegación --}}

    <div class="container mx-auto p-4 mt-4"> {{-- Añadí mt-4 para un poco de espacio --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        {{-- Aquí se cargará el contenido específico de cada vista --}}
        @yield('content')
    </div>

</body>
</html>
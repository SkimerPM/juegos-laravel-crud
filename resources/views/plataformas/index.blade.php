@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Listado de Plataformas</h1>
        <a href="{{ route('plataformas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear Nueva Plataforma
        </a>
    </div>

    @if ($plataformas->isEmpty())
        <p class="text-gray-600">No hay plataformas registradas.</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Creador
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plataformas as $plataforma)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $plataforma->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $plataforma->nombre }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $plataforma->creador ?? 'N/A' }} {{-- Muestra el creador o N/A --}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('plataformas.show', $plataforma->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                    <a href="{{ route('plataformas.edit', $plataforma->id) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                    <form action="{{ route('plataformas.destroy', $plataforma->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta plataforma? Se desvinculará de todos los videojuegos asociados.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $plataformas->links() }} {{-- Paginación --}}
        </div>
    @endif
@endsection
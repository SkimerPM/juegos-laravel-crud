<div class="mb-4">
    <label for="titulo" class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $videojuego->titulo ?? '') }}"
           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('titulo') border-red-500 @enderror"
           required>
    @error('titulo')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="anio" class="block text-gray-700 text-sm font-bold mb-2">Año de Lanzamiento:</label>
    <input type="number" name="anio" id="anio" value="{{ old('anio', $videojuego->anio ?? '') }}"
           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('anio') border-red-500 @enderror"
           required min="1950" max="{{ date('Y') }}">
    @error('anio')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="portada" class="block text-gray-700 text-sm font-bold mb-2">Portada (Imagen):</label>
    <input type="file" name="portada" id="portada"
           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('portada') border-red-500 @enderror">
    @error('portada')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
    @if (isset($videojuego) && $videojuego->portada)
        <div class="mt-2">
            <p class="text-gray-600 text-sm mb-1">Portada actual:</p>
            <img src="{{ asset('storage/' . $videojuego->portada) }}" alt="{{ $videojuego->titulo }}" class="w-32 h-32 object-cover rounded-md border border-gray-300">
        </div>
    @endif
</div>

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Plataformas:</label>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
        @foreach ($plataformas as $plataforma)
            <div class="flex items-center">
                <input type="checkbox" name="plataformas[]" id="plataforma_{{ $plataforma->id }}" value="{{ $plataforma->id }}"
                       class="form-checkbox h-5 w-5 text-blue-600"
                       @if (isset($videojuegoPlataformasIds) && in_array($plataforma->id, $videojuegoPlataformasIds)) checked @endif>
                <label for="plataforma_{{ $plataforma->id }}" class="ml-2 text-gray-700">{{ $plataforma->nombre }}</label>
            </div>
        @endforeach
    </div>
    @error('plataformas')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        {{ isset($videojuego) ? 'Actualizar Videojuego' : 'Crear Videojuego' }}
    </button>
    <a href="{{ route('videojuegos.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
        Cancelar
    </a>
</div>
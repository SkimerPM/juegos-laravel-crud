<div class="mb-4">
    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Plataforma:</label>
    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $plataforma->nombre ?? '') }}"
           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nombre') border-red-500 @enderror"
           required>
    @error('nombre')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        {{ isset($plataforma) ? 'Actualizar Plataforma' : 'Crear Plataforma' }}
    </button>
    <a href="{{ route('plataformas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
        Cancelar
    </a>
</div>
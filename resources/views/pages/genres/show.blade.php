@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">
            {{ $genre->exists ? 'Editar Gênero' : 'Novo Gênero' }}
        </h2>

        @if ($errors->has('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form method="POST" action="{{ $genre->exists ? route('genres.update', $genre) : route('genres.store') }}">
            @csrf
            @if ($genre->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $genre->name) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('genres.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Voltar
                </a>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ $genre->exists ? 'Atualizar' : 'Criar' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">
            {{ $book->exists ? 'Editar Livro' : 'Novo Livro' }}
        </h2>

        @if ($errors->has('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form method="POST" action="{{ $book->exists ? route('books.update', $book) : route('books.store') }}">
            @csrf
            @if ($book->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('author')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="registration_number" class="block text-sm font-medium text-gray-700">Número de registro</label>
                <input type="number" name="registration_number" id="registration_number"
                    value="{{ old('registration_number', $book->registration_number) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('registration_number')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-700">Situação</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="available" {{ old('status', $book->status) === 'available' ? 'selected' : '' }}>
                        Disponível</option>
                    <option value="borrowed" {{ old('status', $book->status) === 'borrowed' ? 'selected' : '' }}>Emprestado
                    </option>
                </select>
                @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-700">Gênero</label>
                <select name="genre[]" id="genre" multiple
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ in_array($genre->id, $book->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('books.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Voltar
                </a>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ $book->exists ? 'Atualizar' : 'Criar' }}
                </button>
            </div>
        </form>
    </div>
@endsection

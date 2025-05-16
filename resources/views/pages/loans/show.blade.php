@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">
            Novo Empréstimo
        </h2>

        @if ($errors->has('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('loans.store') }}">
            @csrf


            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Usuário</label>
                <select name="user_id" id="user_id"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ (int) old('user_id') === $user->id ? 'selected' : '' }}>
                            {{ $user->registration_number . ' - ' . $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="book_id" class="block text-sm font-medium text-gray-700">Livro</label>
                <select name="book_id" id="book_id"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ (int) old('book_id') === $book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
                @error('book_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Devolução em</label>
                <input type="date" name="due_date" id="due_date"
                    value="{{ old('due_date', $loan->due_date?->format('Y-m-d')) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('due_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('loans.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Voltar
                </a>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ $loan->exists ? 'Atualizar' : 'Criar' }}
                </button>
            </div>
        </form>
    </div>
@endsection

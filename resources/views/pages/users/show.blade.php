@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">
            {{ $user->exists ? 'Editar Usuário' : 'Novo Usuário' }}
        </h2>

        @if ($errors->has('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}">
            @csrf
            @if ($user->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="registration_number" class="block text-sm font-medium text-gray-700">Número de Matrícula</label>
                <input type="number" name="registration_number" id="registration_number"
                    value="{{ old('registration_number', $user->registration_number) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('registration_number')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Voltar
                </a>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ $user->exists ? 'Atualizar' : 'Criar' }}
                </button>
            </div>
        </form>
    </div>
@endsection

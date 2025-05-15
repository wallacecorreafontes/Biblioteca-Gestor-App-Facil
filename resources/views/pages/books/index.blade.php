@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Lista de Livros</h2>
            <a href="{{ route('books.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Novo Livro
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Título</th>
                        <th class="px-4 py-2 text-left">Número de Registro</th>
                        <th class="px-4 py-2 text-left">Situação</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $book->id }}</td>
                            <td class="px-4 py-2">{{ $book->title }}</td>
                            <td class="px-4 py-2">{{ $book->registration_number }}</td>
                            <td class="px-4 py-2">{{ $book->status() }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Editar</a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja remover este usuário?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Remover
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Nenhum usuário encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
@endsection

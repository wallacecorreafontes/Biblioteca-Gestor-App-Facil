@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Lista de Empréstimos</h2>
            <a href="{{ route('loans.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Novo Empréstimo
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
                        <th class="px-4 py-2 text-left">Usuário</th>
                        <th class="px-4 py-2 text-left">Livro</th>
                        <th class="px-4 py-2 text-left">Emprestado em</th>
                        <th class="px-4 py-2 text-left">Previsão de entrega em</th>
                        <th class="px-4 py-2 text-left">Situação</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $loan->id }}</td>
                            <td class="px-4 py-2">{{ $loan->user->name }}</td>
                            <td class="px-4 py-2">{{ $loan->book->title }}</td>
                            <td class="px-4 py-2">{{ $loan->formatted_borrowed_at }}</td>
                            <td class="px-4 py-2">{{ $loan->formatted_due_date }}</td>
                            <td class="px-4 py-2">{{ $loan->status() }}</td>
                            <td class="px-4 py-2">
                                @if (!$loan->returned_at)
                                    <form action="{{ route('loans.return', $loan) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja marcar como devolvido esse empréstimo?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:underline">
                                            Marcar como devolvido
                                        </button>
                                    </form>
                                @else
                                    <small class="text-gray-400">Sem ações disponíveis</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                Nenhum empréstimo encontrado.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    </div>
@endsection

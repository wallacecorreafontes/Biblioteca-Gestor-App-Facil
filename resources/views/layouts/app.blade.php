<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Biblioteca Gestor App Fácil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-700 text-white p-4 shadow-md flex items-center justify-between">
        <h1 class="text-xl font-bold">Biblioteca Gestor App Fácil</h1>
        <nav class="space-x-4 hidden md:block">
            <a href="{{ url('/') }}" class="hover:underline">
                Home
            </a>
            <a href="{{ route('users.index') }}" class="hover:underline">
                Usuários
            </a>
            <a href="{{ route('genres.index') }}" class="hover:underline">
                Gêneros
            </a>
            <a href="{{ route('books.index') }}" class="hover:underline">
                Livros
            </a>
            <a href="{{ route('loans.index') }}" class="hover:underline">
                Empréstimos
            </a>
        </nav>
    </header>

    <div class="flex flex-1">
        <aside class="bg-white w-64 p-6 border-r border-gray-200 hidden md:block">
            <nav class="flex flex-col space-y-4">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-700 font-semibold">
                    Home
                </a>
                <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-blue-700 font-semibold">
                    Usuários
                </a>
                <a href="{{ route('genres.index') }}" class="text-gray-700 hover:text-blue-700 font-semibold">
                    Gêneros
                </a>
                <a href="{{ route('books.index') }}" class="text-gray-700 hover:text-blue-700 font-semibold">
                    Livros
                </a>
                <a href="{{ route('loans.index') }}" class="text-gray-700 hover:text-blue-700 font-semibold">
                    Empréstimos
                </a>
            </nav>
        </aside>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
    <footer class="bg-blue-700 text-white text-center p-4 mt-auto">
        &copy; {{ date('Y') }} Biblioteca Gestor App Fácil.
    </footer>

</body>

</html>

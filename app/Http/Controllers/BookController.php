<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(15);
        return view('pages.books.index', compact('books'));
    }

    public function create()
    {
        $book = new Book();
        $genres = Genre::all();
        return view('pages.books.show', compact('book', 'genres'));
    }

    public function store(BookRequest $request)
    {
        try {
            DB::beginTransaction();

            Book::create($request->validated());

            DB::commit();

            return redirect()->route('books.index')
                ->with('success', 'Livro criado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao criar livro: ' . $e->getMessage()]);
        }
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('pages.books.show', compact('book', 'genres'));
    }

    public function update(BookRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();

            $book->update($request->validated());
            $book->genres()->sync($request->genre);

            DB::commit();

            return redirect()->route('books.index')
                ->with('success', 'Livro atualizado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao atualizar usuário: ' . $e->getMessage()]);
        }
    }

    public function destroy(Book $book)
    {
        try {
            DB::beginTransaction();

            $book->delete();

            DB::commit();

            return redirect()->route('books.index')
                ->with('success', 'Livro removido com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Erro inesperado ao remover usuário: ' . $e->getMessage()]);
        }
    }
}

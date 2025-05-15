<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::paginate(15);
        return view('pages.genres.index', compact('genres'));
    }

    public function create()
    {
        $genre = new Genre();
        return view('pages.genres.show', compact('genre'));
    }

    public function store(GenreRequest $request)
    {
        try {
            DB::beginTransaction();

            Genre::create($request->validated());

            DB::commit();

            return redirect()->route('genres.index')
                ->with('success', 'Gênero criado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao criar gênero: ' . $e->getMessage()]);
        }
    }

    public function edit(Genre $genre)
    {
        return view('pages.genres.show', compact('genre'));
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        try {
            DB::beginTransaction();

            $genre->update($request->validated());

            DB::commit();

            return redirect()->route('genres.index')
                ->with('success', 'Gênero atualizado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao atualizar gênero: ' . $e->getMessage()]);
        }
    }

    public function destroy(Genre $genre)
    {
        try {
            DB::beginTransaction();

            $genre->delete();

            DB::commit();

            return redirect()->route('genres.index')
                ->with('success', 'Gênero removido com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Erro inesperado ao remover gênero: ' . $e->getMessage()]);
        }
    }
}

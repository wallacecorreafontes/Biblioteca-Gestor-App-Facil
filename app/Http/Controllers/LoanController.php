<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::paginate(15);
        return view('pages.loans.index', compact('loans'));
    }

    public function create()
    {
        $loan = new Loan();
        $books = Book::available()->get();
        $users = User::get();
        return view('pages.loans.show', compact('loan', 'books', 'users'));
    }

    public function store(LoanRequest $request)
    {
        try {
            DB::beginTransaction();

            Loan::create($request->validated());

            DB::commit();

            return redirect()->route('loans.index')
                ->with('success', 'Gênero criado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao criar empréstimo: ' . $e->getMessage()]);
        }
    }

    public function destroy(Loan $loan)
    {
        try {
            DB::beginTransaction();

            $loan->delete();

            DB::commit();

            return redirect()->route('loans.index')
                ->with('success', 'Gênero removido com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Erro inesperado ao remover empréstimo: ' . $e->getMessage()]);
        }
    }

    public function markAsReturned(Loan $loan)
    {
        try {
            DB::beginTransaction();

            $loan->markAsReturned();

            DB::commit();

            return redirect()->route('loans.index')
                ->with('success', 'Livro marcado como devolvido com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Erro ao marcar como devolvido: ' . $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        return view('pages.users.show', compact('user'));
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::withTrashed()->where('email', $request->email)->first();

            if ($user) {
                if ($user->trashed()) {
                    $user->restore();
                    $user->update($request->validated());
                } else {
                    abort(422, 'Usuário com este e-mail já existe.');
                }
            } else {
                User::create($request->validated());
            }

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'Usuário criado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao criar usuário: ' . $e->getMessage()]);
        }
    }

    public function edit(User $user)
    {
        return view('pages.users.show', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $user->update($request->validated());

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro inesperado ao atualizar usuário: ' . $e->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'Usuário removido com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Erro inesperado ao remover usuário: ' . $e->getMessage()]);
        }
    }
}

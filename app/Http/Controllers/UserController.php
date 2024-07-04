<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('no-view-adm');

        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('cpf_cnpj', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(7);

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $user = User::query()->create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'mobile'     => $request->mobile,
            'role'       => $request->role,
            'cpf_cnpj'   => $request->cpf_cnpj,
            'user_notes' => $request->user_notes,
            'password'   => bcrypt($request->password),
            'cep'        => $request->cep,
            'rua'        => $request->rua,
            'bairro'     => $request->bairro,
            'cidade'     => $request->cidade,
        ]);

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function edit(User $user)
    {
        $users = User::all();

        return view('users.edit', compact('user', 'users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:15',
            'cpf_cnpj' => 'nullable|string|max:14',
            'role'     => 'required|integer',
        ]);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'cpf_cnpj' => $request->cpf_cnpj,
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $users = User::query()->orderBy('created_at', 'desc')->paginate(20);

        return view('users.create', compact('users'));
    }
}

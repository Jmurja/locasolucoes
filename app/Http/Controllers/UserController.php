<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('created_at', 'desc')->paginate(7);

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
        $user->update($request->all());

        return redirect()->route('users.index');
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('created_at', 'desc')->paginate(20);

        return view('users.index', compact('users'));
    }

    public function store(Request $resquest)
    {
        dd($resquest->all());
    }

    public function destroy(User $user)
    {
        ($user->name);
    }
}

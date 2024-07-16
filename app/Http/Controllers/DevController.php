<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        Auth::login($user);

        return redirect()->route('dashboard.index');
    }
}

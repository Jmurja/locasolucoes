<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $RentalItems = RentalItem::all();
        $users       = User::all();

        return view('welcome.welcome', compact('RentalItems', 'users'));
    }
}

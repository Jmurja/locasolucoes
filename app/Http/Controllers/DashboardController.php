<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;

class DashboardController extends Controller
{
    public function index()
    {
        $RentalItems = RentalItem::all();

        return view('dashboard.dashboard', compact('RentalItems'));
    }
}

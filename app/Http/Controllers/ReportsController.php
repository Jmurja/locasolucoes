<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $users       = User::query()->get();
        $rentalItems = RentalItem::query()->get();
        $reserves    = [];

        if ($request->has('start_date', 'end_date')) {
            $start_date = $request->input('start_date');
            $end_date   = $request->input('end_date');
            $reserves   = Reserve::query()->whereBetween('start_date', [$start_date, $end_date])->get();
        }

        return view('reports.index', compact('users', 'rentalItems', 'reserves'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view-users');

        $users       = User::all();
        $rentalItems = RentalItem::all();
        $reserves    = Reserve::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start_date = $request->input('start_date');
            $end_date   = $request->input('end_date');
            $reserves->whereBetween('start_date', [$start_date, $end_date]);
        }

        if ($request->filled('user_id')) {
            $user_id = $request->input('user_id');
            $reserves->where('user_id', $user_id);
        }

        $reserves = $reserves->get();

        return view('reports.index', compact('users', 'rentalItems', 'reserves'));
    }

    public function generatePdf(Request $request)
    {
        $users       = User::all();
        $rentalItems = RentalItem::all();
        $reserves    = Reserve::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start_date = $request->input('start_date');
            $end_date   = $request->input('end_date');
            $reserves->whereBetween('start_date', [$start_date, $end_date]);
        }

        if ($request->filled('user_id')) {
            $user_id = $request->input('user_id');
            $reserves->where('user_id', $user_id);
        }

        $reserves = $reserves->get();

        $pdf = Pdf::loadView('reports.pdf', compact('users', 'rentalItems', 'reserves'));

        return $pdf->stream('relatorio.pdf');
    }
}

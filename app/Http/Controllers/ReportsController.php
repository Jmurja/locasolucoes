<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $users       = User::all();
        $rentalItems = RentalItem::all();
        $reserves    = [];

        if ($request->has('start_date', 'end_date')) {
            $start_date = $request->input('start_date');
            $end_date   = $request->input('end_date');
            $reserves   = Reserve::whereBetween('start_date', [$start_date, $end_date])->get();
        }

        return view('reports.index', compact('users', 'rentalItems', 'reserves'));
    }

    public function generatePdf(Request $request)
    {
        $users       = User::all();
        $rentalItems = RentalItem::all();
        $reserves    = [];

        if ($request->has('start_date', 'end_date')) {
            $start_date = $request->input('start_date');
            $end_date   = $request->input('end_date');
            $reserves   = Reserve::whereBetween('start_date', [$start_date, $end_date])->get();
        }

        $pdf = Pdf::loadView('reports.pdf', compact('users', 'rentalItems', 'reserves'));

        return $pdf->stream('relatorio.pdf');
    }
}

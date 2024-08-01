<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $RentalItems      = RentalItem::all();
        $Reserves         = Reserve::all();
        $upcomingReserves = $this->getUpcomingReserves();

        return view('dashboard.dashboard', compact('RentalItems', 'Reserves', 'upcomingReserves'));
    }

    private function getUpcomingReserves()
    {
        $today    = Carbon::today();
        $nextWeek = Carbon::today()->addDays(7);

        return Reserve::whereBetween('start_date', [$today, $nextWeek])->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        $reserves = Reserve::query()->orderBy('created_at', 'desc')->paginate(20);

        return view('reserves.index', compact('reserves'));
    }

    public function store(Request $request)
    {
        Reserve::query()->create([
            'user_id'        => $request->user_id,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'rental_item_id' => $request->rental_item_id,
            'reserve_notes'  => $request->reserve_notes,
        ]);

        return back();
    }

    public function create(Request $request)
    {
        $users       = User::query()->orderBy('created_at', 'desc')->paginate(20);
        $RentalItems = RentalItem::all();

        return view('reserves.create', compact('RentalItems', 'users'));
    }

    public function json()
    {
        $reserves = Reserve::all();
        $events   = $reserves->map(function($reserve) {
            return [
                'id'            => $reserve->id,
                'title'         => $reserve->user->name,
                'start'         => $reserve->start_date,
                'end'           => $reserve->end_date,
                'extendedProps' => [
                    'user_id'        => $reserve->user_id,
                    'rental_item_id' => $reserve->rental_item_id,
                    'reserve_notes'  => $reserve->reserve_notes,
                    'description'    => $reserve->user->name,
                ],
            ];
        });

        return response()->json($events);
    }
}

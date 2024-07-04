<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('no-view-adm');

        $query = Reserve::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('role', 'LIKE', "%{$search}%");
            })
                ->orWhereHas('rentalitem', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhere('start_date', 'LIKE', "%{$search}%")
                ->orWhere('end_date', 'LIKE', "%{$search}%");
        }

        $reserves    = $query->orderBy('created_at', 'desc')->paginate(20);
        $users       = User::all();
        $RentalItems = RentalItem::all();

        return view('reserves.index', compact('reserves', 'RentalItems', 'users'));
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

    public function show($id)
    {
        $reserve = Reserve::with(['user', 'rentalitem'])->find($id);

        return response()->json($reserve);
    }

    public function destroy(Reserve $reserf)
    {
        $reserve = $reserf;

        $reserve->delete();

        return redirect()->route('reserves.index');
    }

    public function edit(Reserve $reserf)
    {
        $users   = User::all();
        $reserve = $reserf;

        return view('reserves.edit', compact('reserve', 'users'));
    }

    public function update(Request $request, Reserve $reserf)
    {
        $reserveUpdated = $request->all();
        $reserf->update($reserveUpdated);

        return redirect()->route('reserves.index');
    }
}

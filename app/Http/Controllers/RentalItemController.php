<?php

namespace App\Http\Controllers;

use App\Enum\RentalItemStatus;
use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RentalItemController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view-users');

        $query = RentalItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('price_per_hour', 'LIKE', "%{$search}%")
                    ->orWhere('price_per_day', 'LIKE', "%{$search}%")
                    ->orWhere('price_per_month', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            });
        }

        $rentalItems   = $query->orderBy('created_at', 'desc')->paginate(7);
        $landLordUsers = User::query()->where('role', 'landlord')->get();
        $statuses      = RentalItemStatus::options();

        return view('rental-items.index', compact('rentalItems', 'landLordUsers', 'statuses'));
    }

    public function create()
    {
        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.create', compact('landLordUsers'));
    }

    public function store(Request $request)
    {
        RentalItem::query()->create([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'price_per_hour'    => $request->price_per_hour,
            'price_per_day'     => $request->price_per_day,
            'price_per_month'   => $request->price_per_month,
            'status'            => $request->status,
            'rental_item_notes' => $request->rental_item_notes,
        ]);

        return back();
    }

    public function show(RentalItem $rentalItem)
    {
        return response()->json($rentalItem);
    }

    public function destroy(RentalItem $rentalItem)
    {
        $rentalItem->delete();

        return redirect()->route('rental-items.index');
    }

    public function edit(RentalItem $rentalItem)
    {
        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.edit', compact('rentalItem', 'landLordUsers'));
    }

    public function update(Request $request, RentalItem $rentalItem)
    {
        $rentalItemUpdated = $request->all();
        $rentalItem->update($rentalItemUpdated);

        return redirect()->route('rental-items.index');
    }
}

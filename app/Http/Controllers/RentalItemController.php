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
        Gate::authorize('simple-user');

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

    public function store(Request $request)
    {
        RentalItem::query()->create([
            'user_id'        => $request->user_id,
            'name'           => $request->name,
            'description'    => $request->description,
            'price_per_hour' => preg_replace(
                '/[^\d]/',
                '',
                str_replace(['.', ','], '', $request->price_per_hour)
            )                                                                                                      / 100,
            'price_per_day'   => preg_replace('/[^\d]/', '', str_replace(['.', ','], '', $request->price_per_day)) / 100,
            'price_per_month' => preg_replace(
                '/[^\d]/',
                '',
                str_replace(['.', ','], '', $request->price_per_month)
            ) / 100,
            'status'            => $request->status,
            'rental_item_notes' => $request->rental_item_notes,
        ]);

        return back();
    }

    public function update(Request $request, RentalItem $rentalItem)
    {
        $updatedData = $request->only([
            'user_id',
            'name',
            'description',
            'price_per_hour',
            'price_per_day',
            'price_per_month',
            'status',
            'rental_item_notes'
        ]);

        $updatedData['price_per_hour'] = preg_replace(
            '/[^\d]/',
            '',
            str_replace(['.', ','], '', $updatedData['price_per_hour'])
        );
        $updatedData['price_per_day'] = preg_replace(
            '/[^\d]/',
            '',
            str_replace(['.', ','], '', $updatedData['price_per_day'])
        );
        $updatedData['price_per_month'] = preg_replace(
            '/[^\d]/',
            '',
            str_replace(['.', ','], '', $updatedData['price_per_month'])
        );

        $rentalItem->update($updatedData);

        return redirect()->route('rental-items.index');
    }

    public function show(RentalItem $rentalItem)
    {
        return response()->json($rentalItem);
    }

    public function destroy(RentalItem $rental_item)
    {
        $rental_item->delete();

        return redirect()->route('rental-items.index');
    }
}

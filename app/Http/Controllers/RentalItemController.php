<?php

namespace App\Http\Controllers;

use App\Enum\RentalItemStatus;
use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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

        $rentalItems = $query->orderBy('created_at', 'desc')->paginate(7);
        $rentalItems->load(['uploads']);
        $landLordUsers = User::query()->where('role', 'landlord')->get();
        $statuses      = RentalItemStatus::options();

        return view('rental-items.index', compact('rentalItems', 'landLordUsers', 'statuses'));
    }

    public function store(Request $request)
    {
        $rentalItem = RentalItem::query()->create([
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

        if ($request->hasFile('rental_item_image')) {
            $uploadedFile = $request->file('rental_item_image');
            $path         = $uploadedFile->store('uploads');

            $rentalItem->uploads()->create([
                'file_name' => $uploadedFile->getClientOriginalName(),
                'file_path' => $path,
            ]);
        }

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

        // Formatando os preços para salvar no banco de dados
        $updatedData['price_per_hour'] = preg_replace(
            '/[^\d]/',
            '',
            str_replace(['.', ','], '', $updatedData['price_per_hour'])
        ) / 100;
        $updatedData['price_per_day'] = preg_replace(
            '/[^\d]/',
            '',
            str_replace(['.', ','], '', $updatedData['price_per_day'])
        ) / 100;
        $updatedData['price_per_month'] = preg_replace(
            '/[^\d]/',
            '',
            str_replace(['.', ','], '', $updatedData['price_per_month'])
        ) / 100;

        // Atualizando os dados do item de locação
        $rentalItem->update($updatedData);

        // Lidando com os uploads de imagens, se houver
        if ($request->hasFile('rental_item_images')) {
            foreach ($request->file('rental_item_images') as $uploadedFile) {
                $path = $uploadedFile->store('uploads');

                // Cria uma nova instância de Upload associada ao item de locação
                $rentalItem->uploads()->create([
                    'file_name' => $uploadedFile->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('rental-items.index');
    }

    public function deleteImage(RentalItem $rentalItem)
    {
        $rentalItem->load('uploads');
        $upload = $rentalItem->uploads()->first();
        $upload->delete();
        Storage::delete($upload->file_path);

        return response()->json(['success' => true]);
    }

    public function show(RentalItem $rentalItem)
    {
        $rentalItem->load('uploads');

        return view('rental-items.show', compact('rentalItem'));
    }

    public function getRentalItemData(RentalItem $rentalItem)
    {
        $rentalItem->load('uploads');

        return $rentalItem;
    }

    public function destroy(RentalItem $rentalItem)
    {
        $rentalItem->delete();

        return redirect()->route('rental-items.index');
    }
}

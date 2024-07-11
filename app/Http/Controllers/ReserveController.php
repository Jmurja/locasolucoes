<?php

namespace App\Http\Controllers;

use App\Enum\RentalItemStatus;
use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('simple-user');

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
        $statuses    = RentalItemStatus::options(); // Obter opções de status do enum

        return view('reserves.index', compact('reserves', 'RentalItems', 'users', 'statuses'));
    }

    public function store(Request $request)
    {
        $user = User::where('cpf_cnpj', '=', $request->cpf_cnpj)->first();

        if (!$user) {
            $user = User::query()->create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'mobile'     => $request->mobile,
                'role'       => $request->role,
                'cpf_cnpj'   => $request->cpf_cnpj,
                'user_notes' => $request->user_notes,
                'password'   => bcrypt($request->password),
                'cep'        => $request->cep,
                'rua'        => $request->rua,
                'bairro'     => $request->bairro,
                'cidade'     => $request->cidade,
            ]);
        }

        Reserve::query()->create([
            'user_id'        => $user->id,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'rental_item_id' => $request->rental_item_id,
            'reserve_notes'  => $request->reserve_notes,
            'title'          => $request->title,
        ]);

        return back();
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

    public function update(Request $request, Reserve $reserf)
    {
        $reserveUpdated = $request->all();
        $reserf->update($reserveUpdated);
        $rentalItems = RentalItem::all();

        return view('reserves.index', compact('reserf', 'rentalItems'));
    }
}

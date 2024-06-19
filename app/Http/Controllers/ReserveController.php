<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
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
            'user_id'     => $request->user_id,
            'name'        => $request->name,
            'cpf_cnpj'    => $request->cpf_cnpj,
            'phone'       => $request->phone,
            'mail'        => $request->email,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'interprise'  => $request->interprise,
            'responsible' => $request->responsible,

        ]);

        return back();
    }

    public function create(Request $request)
    {
        $RentalItems = RentalItem::all();

        return view('reserves.create', compact('RentalItems'));
    }

    public function json()
    {
        $reserves = Reserve::query()->orderBy('created_at', 'desc')->get();

        return response()->json($reserves);
    }
}

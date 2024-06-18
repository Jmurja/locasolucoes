<?php

namespace App\Http\Controllers;

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
            'user_id'       => $request->user_id,
            'name'          => $request->name,
            'cpf_cnpj'      => $request->cpf_cnpj,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'total_price'   => $request->total_price,
            'total_hours'   => $request->total_hours,
            'status'        => $request->status,
            'reserve_notes' => $request->reserve_notes,
        ]);

        return back();
    }

    public function create(Request $request)
    {
        return view('reserves.create');
    }
}

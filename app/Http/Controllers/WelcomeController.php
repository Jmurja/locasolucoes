<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $RentalItems = RentalItem::all();

        return view('welcome', compact('RentalItems'));
    }

    public function show($id)
    {
        return view('welcome', ['id' => $id]);
    }

    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $user = User::where('cpf_cnpj', '=', $request->cpf_cnpj)->first();

        if (!$user) {
            $role = $request->input(
                'role',
                'VISITOR'
            );

            $user = User::query()->create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'mobile'     => $request->mobile,
                'role'       => $role,
                'cpf_cnpj'   => $request->cpf_cnpj,
                'user_notes' => $request->user_notes,
                'password'   => bcrypt($request->password),
                'cep'        => $request->cep,
                'rua'        => $request->rua,
                'bairro'     => $request->bairro,
                'cidade'     => $request->cidade,
                'company'    => $request->company,
            ]);
        }

        $FormatStartDate = Carbon::createFromFormat('d/m/Y H:i', $request->start_date . ' ' . $request->start_time);
        $FormatEndDate   = Carbon::createFromFormat('d/m/Y H:i', $request->end_date . ' ' . $request->end_time);

        Reserve::query()->create([
            'user_id'        => $user->id,
            'start_date'     => $FormatStartDate,
            'end_date'       => $FormatEndDate,
            'rental_item_id' => $request->rental_item_id,
            'reserve_notes'  => $request->reserve_notes,
            'title'          => $request->title,
        ]);

        return back();
    }
}

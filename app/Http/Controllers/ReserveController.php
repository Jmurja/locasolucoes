<?php

namespace App\Http\Controllers;

use App\Enum\RentalItemStatus;
use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('tenant-user');

        $query = Reserve::query();

        if (auth()->user()->role === 'tenant') {
            $query->where('user_id', auth()->user()->id);
        }

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

        $reserves = $query->orderBy('created_at', 'desc')->paginate(20);
        $reserves->load(['user']);
        $users       = User::all();
        $RentalItems = RentalItem::all();
        $statuses    = RentalItemStatus::options();

        return view('reserves.index', compact('reserves', 'RentalItems', 'users', 'statuses'));
    }

    public function store(Request $request)
    {
        // Depuração: Exibir entradas recebidas
        \Log::info('Entradas recebidas:', $request->all());

        $startDateTime = $request->input('start_date') . ' ' . $request->input('start_time');
        $endDateTime   = $request->input('end_date') . ' ' . $request->input('end_time');

        try {
            $FormatStartDate = Carbon::createFromFormat('d/m/Y H:i', $startDateTime)->format('Y-m-d H:i:s');
            $FormatEndDate   = Carbon::createFromFormat('d/m/Y H:i', $endDateTime)->format('Y-m-d H:i:s');
            // Depuração: Exibir datas formatadas
            \Log::info('Datas formatadas:', ['start' => $FormatStartDate, 'end' => $FormatEndDate]);
        } catch (\Exception $e) {
            return back()->withErrors(['date_format' => 'O formato da data ou hora está incorreto.'])->withInput();
        }

        $existingReserve = Reserve::where('rental_item_id', $request->rental_item_id)
            ->where(function($query) use ($FormatStartDate, $FormatEndDate) {
                $query->whereBetween('start_date', [$FormatStartDate, $FormatEndDate])
                    ->orWhereBetween('end_date', [$FormatStartDate, $FormatEndDate])
                    ->orWhere(function($query) use ($FormatStartDate, $FormatEndDate) {
                        $query->where('start_date', '<=', $FormatStartDate)
                            ->where('end_date', '>=', $FormatEndDate);
                    });
            })
            ->first();

        if ($existingReserve) {
            $conflictMessage = "Já existe uma reserva no mesmo período: " . $existingReserve->title
                . " de " . Carbon::parse($existingReserve->start_date)->format('d/m/Y H:i')
                . " até " . Carbon::parse($existingReserve->end_date)->format('d/m/Y H:i') . ".";

            return back()->withErrors(['conflict' => $conflictMessage])->withInput();
        }

        $user = User::where('cpf_cnpj', '=', $request->cpf_cnpj)->first();

        if (!$user) {
            $role = $request->input('role', 'VISITANTE');
            $user = User::create([
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

        Reserve::create([
            'user_id'        => $user->id,
            'start_date'     => $FormatStartDate,
            'end_date'       => $FormatEndDate,
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
                'title'         => $reserve->title,
                'start'         => $reserve->start_date,
                'end'           => $reserve->end_date,
                'extendedProps' => [
                    'user_id'        => $reserve->user_id,
                    'rental_item_id' => $reserve->rental_item_id,
                    'reserve_notes'  => $reserve->reserve_notes,
                    'description'    => $reserve->reserve_notes,
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

    public function destroy(Reserve $reserve)
    {
        $reserve->delete();

        return redirect()->route('reserves.index')->with('success', 'Reserva deletada com sucesso.');
    }

    public function update(Request $request, Reserve $reserve)
    {
        // Depuração: Exibir entradas recebidas
        \Log::info('Entradas recebidas:', $request->all());

        $startDateTime = $request->input('start_date') . ' ' . $request->input('start_time');
        $endDateTime   = $request->input('end_date') . ' ' . $request->input('end_time');

        try {
            $FormatStartDate = Carbon::createFromFormat('d/m/Y H:i', $startDateTime)->format('Y-m-d H:i:s');
            $FormatEndDate   = Carbon::createFromFormat('d/m/Y H:i', $endDateTime)->format('Y-m-d H:i:s');
            // Depuração: Exibir datas formatadas
            \Log::info('Datas formatadas:', ['start' => $FormatStartDate, 'end' => $FormatEndDate]);
        } catch (\Exception $e) {
            return back()->withErrors(['date_format' => 'O formato da data ou hora está incorreto.'])->withInput();
        }

        $existingReserve = Reserve::where('rental_item_id', $request->rental_item_id)
            ->where('id', '!=', $reserve->id)
            ->where(function($query) use ($FormatStartDate, $FormatEndDate) {
                $query->whereBetween('start_date', [$FormatStartDate, $FormatEndDate])
                    ->orWhereBetween('end_date', [$FormatStartDate, $FormatEndDate])
                    ->orWhere(function($query) use ($FormatStartDate, $FormatEndDate) {
                        $query->where('start_date', '<=', $FormatStartDate)
                            ->where('end_date', '>=', $FormatEndDate);
                    });
            })
            ->exists();

        if ($existingReserve) {
            return back()->withErrors(['conflict' => 'Já existe uma reserva no mesmo período.']);
        }

        $reserve->update([
            'start_date'     => $FormatStartDate,
            'end_date'       => $FormatEndDate,
            'rental_item_id' => $request->rental_item_id,
            'reserve_notes'  => $request->reserve_notes,
            'title'          => $request->title,
        ]);

        return back()->with('success', 'Reserva atualizada com sucesso.');
    }
}

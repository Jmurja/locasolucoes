<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('simple-user');
        $uploads = Upload::all();
        $query   = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('cpf_cnpj', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(7);

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $input             = $request->all();
        $input['phone']    = preg_replace('/\D/', '', $input['phone']);
        $input['cpf_cnpj'] = preg_replace('/\D/', '', $input['cpf_cnpj']);
        $input['cep']      = preg_replace('/\D/', '', $input['cep']);

        $user = User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'phone'    => $input['phone'],
            'role'     => $input['role'],
            'cpf_cnpj' => $input['cpf_cnpj'],
            'password' => bcrypt($input['password']),
            'cep'      => $input['cep'],
            'rua'      => $input['rua'],
            'bairro'   => $input['bairro'],
            'cidade'   => $input['cidade'],
            'company'  => $input['company'],
            'number'   => $input['number'],
        ]);

        if ($request->hasFile('user_image')) {
            $uploadedFile = $request->file('user_image');
            $path         = $uploadedFile->store('uploads');

            $user->uploads()->create([
                'file_name' => $uploadedFile->getClientOriginalName(),
                'file_path' => $path,
            ]);
        }

        return back();
    }

    public function checkEmail($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true, 'user' => $user]);
        }

        return response()->json(['exists' => false]);
    }

    public function destroy(User $user)
    {
        // Remover uploads associados
        foreach ($user->uploads as $upload) {
            Storage::delete($upload->file_path);
            $upload->delete();
        }

        $user->delete();

        return back();
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function getUserData($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, User $user)
    {
        $input             = $request->all();
        $input['phone']    = preg_replace('/\D/', '', $input['phone']);
        $input['cpf_cnpj'] = preg_replace('/\D/', '', $input['cpf_cnpj']);
        $input['cep']      = preg_replace('/\D/', '', $input['cep']);

        // Atualiza os dados do usuário
        $user->update($input);

        // Lidar com a nova imagem
        if ($request->hasFile('user_image')) {
            // Remove a imagem antiga, se necessário
            foreach ($user->uploads as $upload) {
                Storage::delete($upload->file_path);
                $upload->delete();
            }

            // Upload da nova imagem
            $uploadedFile = $request->file('user_image');
            $path         = $uploadedFile->store('uploads');

            $user->uploads()->create([
                'file_name' => $uploadedFile->getClientOriginalName(),
                'file_path' => $path,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function removeImage($id)
    {
        $upload = Upload::findOrFail($id);
        Storage::delete($upload->file_path);
        $upload->delete();

        return response()->json(['success' => true]);
    }
}

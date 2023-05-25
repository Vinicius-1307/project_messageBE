<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $verifyNameAlreadyExist = User::where('name', $data['name'])->first();

        if ($verifyNameAlreadyExist) return response()->json(['Message' => 'Esse nome já existe.'], 400);

        try {
            $user = User::create([
                'name' => $data['name'],
                'password' => bcrypt($data['password']),
                'is_admin' => false
            ]);
            return response()->json(['Message' => 'Usuário criado com sucesso.'], 201);
        } catch (\Throwable $th) {
            return response()->json(['Message' => 'Erro ao criar usuário.', 'DevMessage' => $th->getMessage()], 400);
        }
    }
    public function login(Request $request){
        $data = $request->all();
        $verifyNameAlreadyExist = User::where('name', $data['name'])->first();
        if (!$verifyNameAlreadyExist) return response()->json(['Message' => 'Usuário não encontrado.'], 400);
        if (!password_verify($data['password'], $verifyNameAlreadyExist->password)){
            return response()->json(['Message' => 'Credenciais incorretas.'], 400);
        }
        return response()->json(['Message' => 'Usuário logado com sucesso', 'data' => $verifyNameAlreadyExist], 200);
    }
}

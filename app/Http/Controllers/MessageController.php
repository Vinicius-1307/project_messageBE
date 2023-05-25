<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\read;



class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $message = Message::create([
                'text' => $data['text'],
                'is_read' => $data['is_read']
            ]);
            return response()->json(['Message' => 'Mensagem criada com sucesso.'], 201);
        } catch (\Throwable $th) {
            return response()->json(['Message' => 'Erro ao criar mensagem.', 'DevMessage' => $th->getMessage()], 400);
        }
    }
    public function index()
    {
        $messages = Message::all();
        if (empty($messages)) {
            return response()->json(['Message' => 'Não contém nenhuma mensagem.', 'data' => []], 400);
        }
        return response()->json(['Message' => 'Lista de mensagens.', 'data' => $messages], 200);
    }

    public function read()
    {
        $messages = Message::where('is_read', 0)->get();
        return response()->json(['Message' => 'Lista de mensagens não lidas.', 'data' => $messages], 200);
    }
}

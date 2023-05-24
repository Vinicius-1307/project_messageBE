<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $message = Message::create([
            'text' => $data['text'],

        ]);
    }
}

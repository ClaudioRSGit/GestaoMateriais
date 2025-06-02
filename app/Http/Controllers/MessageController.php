<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }

    public function toggleRead($id)
    {
        $message = Message::findOrFail($id);
        $message->is_read = !$message->is_read;
        $message->save();

        return redirect()->back()->with('success', 'Estado da mensagem atualizado!');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Mensagem apagada!');
    }
}

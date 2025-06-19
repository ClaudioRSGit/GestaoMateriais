<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Message;
use App\SiteStat;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acesso negado');
        }

        $posts = Post::all();

        foreach ($posts as $post) {
            if ($post->expires_at && now()->gt($post->expires_at) && $post->is_active) {
                $post->update(['is_active' => false]);
            }
        }

        $messages = Message::all();
        $visitCount = SiteStat::first()->visits ?? 0;
        $users = User::all();

        return view('home', compact('posts', 'messages', 'visitCount', 'users'));
    }
}

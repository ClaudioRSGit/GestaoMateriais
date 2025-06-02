<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('landing', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'description' => 'required|string',
            'contact' => 'required|string|max:255',
        ]);

        Post::create($request->only(['title', 'url', 'description', 'contact']));

        return redirect('/')->with('success', 'Material publicado com sucesso!');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function approve($id)
    {
        $post = Post::findOrFail($id);
        $post->is_approved = true;
        $post->save();

        return redirect()->back()->with('success', 'Anúncio aprovado!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->is_deleted = true;
        $post->save();

        return redirect()->back()->with('success', 'Anúncio apagado!');
    }

    public function restore($id)
    {
        $post = Post::findOrFail($id);
        $post->is_deleted = false;
        $post->save();

        return redirect()->back()->with('status', 'Post recuperado com sucesso!');
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\SiteStat;

class PostController extends Controller
{
    public function index()
    {
        $stat = SiteStat::first();

        if (!$stat) {
            $stat = SiteStat::create(['visits' => 1]);
        } else {
            $stat->increment('visits');
        }

        $posts = Post::where('is_deleted', false)->where('is_approved', true)->get();
        return view('landing', compact('posts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'contact' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'attachment' => 'nullable|file|max:512000', // 500MB
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $data['attachment_path'] = $path;
        }

        $data['expires_at'] = now()->addDays($data['duration_days']);
        $data['is_active'] = true;

        Post::create($data);

        return redirect('/')->with('success', 'Anúncio publicado com sucesso, aguarda aprovação!');
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

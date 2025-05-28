<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Interfaces\PostInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{


    protected $repo;

    public function __construct(PostInterface $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $posts = $this->repo->getUserPosts($request->only(['status', 'date']));
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $platforms = \App\Models\Platform::all();
        return view('posts.create', compact('platforms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_time' => 'required|date',
            'status' => 'required|in:draft,scheduled,published',
            'platforms' => 'required|array',
        ]);

        $validated['user_id'] = auth()->id();

        $this->repo->create($validated);
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        $platforms = \App\Models\Platform::all();
        return view('posts.edit', compact('post', 'platforms'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_time' => 'required|date',
            'status' => 'required|in:draft,scheduled,published',
            'platforms' => 'required|array',
        ]);

        $this->repo->update($id, $validated);
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('posts.index');
    }
}

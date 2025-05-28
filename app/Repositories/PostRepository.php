<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Interfaces\PostInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PostRepository implements PostInterface
{
     public function create(Request $data)
    {
        $post = Post::create($data);
        $post->platforms()->sync($data['platforms']);
        return $post;
    }

    public function getUserPosts($filters)
    {
        $query = Post::where('user_id', Auth::id());

        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }

        if ($filters['date']) {
            $query->whereDate('scheduled_time', $filters['date']);
        }

        return $query->latest()->get();
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        $post->update($data);
        $post->platforms()->sync($data['platforms']);
        return $post;
    }

    public function delete($id)
    {
        return Post::destroy($id);
    }

    public function find($id)
    {
        return Post::where('user_id', Auth::id())->findOrFail($id);
    }
}

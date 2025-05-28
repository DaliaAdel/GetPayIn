@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Posts</h2>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">+ New Post</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Scheduled</th>
                <th>Status</th>
                <th>Platforms</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ \Carbon\Carbon::parse($post->scheduled_time)->format('d M Y h:i A') }}</td>
                <td><span class="badge bg-info">{{ ucfirst($post->status) }}</span></td>
                <td>
                    @foreach ($post->platforms as $platform)
                        <span class="badge bg-secondary">{{ ucfirst($platform->name) }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this post?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No posts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Post</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="title">Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
        </div>

        <div class="mb-3">
            <label for="content">Content *</label>
            <textarea name="content" class="form-control" rows="5" id="content">{{ old('content', $post->content) }}</textarea>
            <small id="charCount">{{ strlen(old('content', $post->content)) }} characters</small>
        </div>

        <div class="mb-3">
            <label for="scheduled_time">Scheduled Time *</label>
            <input type="datetime-local" name="scheduled_time" class="form-control"
                value="{{ old('scheduled_time', \Carbon\Carbon::parse($post->sche_

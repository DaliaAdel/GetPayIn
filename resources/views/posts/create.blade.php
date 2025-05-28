@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Post</h2>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title">Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="content">Content *</label>
            <textarea name="content" class="form-control" rows="5" id="content">{{ old('content') }}</textarea>
            <small id="charCount">0 characters</small>
            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="scheduled_time">Scheduled Time *</label>
            <input type="datetime-local" name="scheduled_time" class="form-control" value="{{ old('scheduled_time') }}">
            @error('scheduled_time') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Status *</label>
            <select name="status" class="form-select">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Select Platforms *</label><br>
            @foreach ($platforms as $platform)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="platforms[]" value="{{ $platform->id }}"
                        class="form-check-input" {{ in_array($platform->id, old('platforms', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $platform->name }}</label>
                </div>
            @endforeach
            @error('platforms') <br><span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const textarea = document.getElementById('content');
    const counter = document.getElementById('charCount');

    textarea.addEventListener('input', () => {
        counter.textContent = `${textarea.value.length} characters`;
    });
</script>
@endsection

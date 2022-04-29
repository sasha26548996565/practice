@extends('layouts.admin')

@section('title', 'posts')

@section('content')
    <div class="card text-center mt-2">
        <div class="card-header">
            {{ $post->category->title }} <br>

            @foreach ($post->tags as $tag)
                {{ $tag->title }},
            @endforeach
        </div>

        <div class="card-body">
            <div class="card-title">
                {{ $post->title }}
            </div>

            <div class="card-text">
                {{ $post->text }}
            </div>
        </div>

        <div class="card-footer">
            {{ $post->created_at }}
        </div>
    </div>

    <h2>add comment</h2>

    <form action="{{ route('admin.post.comment.store', $post->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <textarea name="text" class="form-control" placeholder="text">{{ old('text') }}</textarea>
        </div>

        <input type="submit" class="btn btn-success" value="add comment">
    </form>

    <h2>comments</h2>

    @forelse ($post->comments as $comment)
        <p>{{ $comment->user->name }}</p>
        <p>{{ $comment->text }}</p>
        <hr>
    @empty
        no comment
    @endforelse
@endsection

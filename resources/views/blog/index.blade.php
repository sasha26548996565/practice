@extends('layouts.blog')

@section('content')
    @foreach ($posts as $post)
        <div class="card text-center mt-3">
            <div class="card-header">
                {{ $post->category->title }} <br>

                @foreach ($post->tags as $tag)
                    {{ $tag->title }}
                @endforeach
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ Str::limit($post->text, 50) }}</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
                {{ $post->created_at }}
            </div>
        </div>
    @endforeach
@endsection

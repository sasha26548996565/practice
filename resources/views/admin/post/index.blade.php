@extends('layouts.admin')

@section('title', 'posts')

@section('content')
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    @foreach ($posts as $post)
        <div class="card text-center mt-2">
            <div class="card-header">
                {{ $post->category->title }} <br>

                @foreach ($post->tags as $tag)
                    {{ $tag->title }},
                @endforeach

                <form action="{{ route('admin.post.like.store', $post->id) }}" method="POST">
                    @csrf

                    @if (auth()->user()->checkLike($post->id))
                        <input type="submit" class="btn btn-success" value="liked">
                    @else
                        <input type="submit" class="btn btn-danger" value="like it">
                    @endif
                </form>
            </div>

            <div class="card-body">
                <div class="card-title">
                    {{ $post->title }}
<br>
                    likes: {{ $post->likes()->count() }}
                </div>

                <div class="card-text">
                    {{ Str::limit($post->text, 50) }} ...

                    <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-primary">show post</a>
                </div>
            </div>

            <div class="card-footer">
                {{ $post->created_at }}
            </div>
        </div>
    @endforeach
@endsection

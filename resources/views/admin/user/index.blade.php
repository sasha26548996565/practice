@extends('layouts.admin')

@section('title', 'users')

@section('content')
    @can('createUser', auth()->user())
        <h1><a href="{{ route('admin.user.create') }}">create user</a></h1>
    @endcan

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    @foreach ($users as $user)
        <div class="card text-center mt-2">
            <div class="card-header">
                {{ $user->name }}
            </div>

            <div class="card-body">
                <div class="card-title">
                    {{ $user->email }}
                </div>
            </div>
        </div>
    @endforeach
@endsection

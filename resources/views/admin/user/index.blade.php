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

                @can('deleteUser', auth()->user())
                    @if ($user->whetherRemoved())
                        <form action="{{ route('admin.user.restore', $user->id) }}" method="POST">
                            @csrf

                            <input type="submit" class="btn btn-primary" value="restore user">
                        </form>
                    @else
                        @can('updateUser', auth()->user())
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning ml-3">edit</a>
                        @endcan

                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" value="delete user">
                        </form>
                    @endif
                @endcan
            </div>

            <div class="card-body">
                <div class="card-title">
                    {{ $user->email }}
                </div>
            </div>
        </div>
    @endforeach
@endsection

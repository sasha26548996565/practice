@extends('layouts.admin')

@section('title', 'create user')

@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" name="name" placeholder="name" required value="{{ old('name') }}" class="form-control">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="email" required value="{{ old('email') }}" class="form-control">
        </div>

        <div class="form-group">
            <select name="role" class="form-control">
                <option disabled>change role</option>

                @foreach ($data['roles'] as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select name="permissions[]" multiple class="form-control">
                <option disabled>change permission (s)</option>

                @foreach ($data['permissions'] as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="create user">
        </div>
    </form>
@endsection

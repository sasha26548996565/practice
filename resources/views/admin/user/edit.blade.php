@extends('layouts.admin')

@section('title', 'update user')

@section('content')
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <input type="text" name="name" placeholder="name" required value="{{ $user->name }}" class="form-control">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="email" required value="{{ $user->email }}" class="form-control">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="password" required value="{{ $user->password }}" class="form-control">
        </div>

        <div class="form-group">
            <select name="role" class="form-control">
                <option disabled>change role</option>

                @foreach ($data['roles'] as $role)
                    <option value="{{ $role->name }}"
                        {{ $role->name == $user->getRoleName() ? 'selected' : '' }}
                        >{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select name="permissions[]" multiple class="form-control">
                <option disabled>change permission (s)</option>

                @foreach ($data['permissions'] as $permission)
                    <option value="{{ $permission->name }}"
                        {{ is_array($user->getPermissionNames()->toArray()) &&
                            in_array($permission->name, $user->getPermissionNames()->toArray()) ? 'selected' : '' }}
                        >{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="create user">
        </div>
    </form>
@endsection

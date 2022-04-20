<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\IService;
use App\Services\UserService;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\User\StoreRequest;

class UserController extends Controller
{
    private IService $service;
    private Collection $data;

    public function __construct(UserService $service)
    {
        $this->service = $service;

        $this->data = collect();

        $this->data->put('roles', Role::latest()->get());
        $this->data->put('permissions', Permission::latest()->get());
    }

    public function index()
    {
        $users = User::latest()->paginate(15);

        return view('admin.user.index', compact(nameof($users)));
    }

    public function create()
    {
        $data = $this->data;

        return view('admin.user.create', compact(nameof($data)));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return to_route('admin.user.index');
    }
}

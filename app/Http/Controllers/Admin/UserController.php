<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\IService;
use App\Services\UserService;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;

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

    public function index(): View
    {
        $users = User::latest()->paginate(15);

        return view('admin.user.index', compact(nameof($users)));
    }

    public function create(): View
    {
        $data = $this->data;

        return view('admin.user.create', compact(nameof($data)));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->service->store($data);

        return to_route('admin.user.index');
    }

    public function edit(User $user): View
    {
        return view('admin.user.edit', ['user' => $user, 'data' => $this->data]);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        $this->service->update($data, $user);

        return to_route('admin.user.index');
    }
}

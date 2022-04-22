<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Jobs\StoreUserJob;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\User\PasswordMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class UserService implements IService
{
    public function store(array $data)
    {
        try
        {
            DB::beginTransaction();

            StoreUserJob::dispatch($data);

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }

    public function update(array $data, $user)
    {
        try
        {
            DB::beginTransaction();

            $role = $data['role'];
            unset($data['role']);

            if (isset($data['permissions'])) {
                $permissions = $data['permissions'];
                unset($data['permissions']);
            }

            $changePassword = false;

            if ($user->password != $data['password'])
            {
                $changePassword = true;
            }

            $password = $data['password'];
            $data['password'] = Hash::make($password);

            $user->update($data);
            $user->syncRoles($role);

            isset($permissions) ? $user->syncPermissions($permissions) : null;

            if ($changePassword)
            {
                Mail::to($data['email'])->send(new PasswordMail($password));
            }

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }
}

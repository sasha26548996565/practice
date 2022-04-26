<?php

namespace App\Services;

use App\Models\User;
use App\Jobs\StoreUserJob;
use App\Jobs\UpdateUserJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserService implements IService
{
    public function store(array $data): void
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

    public function update(array $data, User|Model $user): void
    {
        try
        {
            DB::beginTransaction();

            UpdateUserJob::dispatch($data, $user);

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }
}

<?php

namespace App\Services;

use App\Jobs\StoreUserJob;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\User\PasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class UserService implements IService
{
    public function store($data)
    {
        try
        {
            StoreUserJob::dispatch($data);

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }

    public function update($data, $post)
    {

    }
}

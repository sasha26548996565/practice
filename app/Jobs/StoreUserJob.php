<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\User\PasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class StoreUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $role = $this->data['role'];
        unset($this->data['role']);

        if (isset($this->data['permissions'])) {
            $permissions = $this->data['permissions'];
            unset($this->data['permissions']);
        }

        $password = Str::random(10);
        $this->data['password'] = $password;

        $user = User::create($this->data);
        $user->assignRole($role);

        isset($permissions) ? $user->givePermissionTo($permissions) : null;

        Mail::to($this->data['email'])->send(new PasswordMail($password));
        event(new Registered($user));
    }
}

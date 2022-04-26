<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;
    private User $user;

    public function __construct(array $data, User $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function handle(): void
    {
        $role = $this->data['role'];
        unset($this->data['role']);

        if (isset($this->data['permissions'])) {
            $permissions = $this->data['permissions'];
            unset($this->data['permissions']);
        }

        $changePassword = false;

        if ($this->user->password != $this->data['password']) {
            $changePassword = true;
        }

        $password = $this->data['password'];
        $this->data['password'] = Hash::make($password);

        $this->user->update($this->data);
        $this->user->syncRoles($role);

        isset($permissions) ? $this->user->syncPermissions($permissions) : null;

        if ($changePassword) {
            Mail::to($this->data['email'])->send(new PasswordMail($password));
        }
    }
}

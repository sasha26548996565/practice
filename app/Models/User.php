<?php

namespace App\Models;

use App\Notifications\SendVerifyWithQueueNotification;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public const ADMIN_ROLE = 'admin';
    public const USER_ROLE = 'user';

    public const EDIT_POST_PERMISSION = 'edit-post';
    public const DELETE_POST_PERMISSION = 'delete-post';

    public const CREATE_USER_PERMISSION = 'create-user';
    public const EDIT_USER_PERMISSION = 'edit-user';
    public const DELETE_USER_PERMISSION = 'delete-user';

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendVerifyWithQueueNotification());
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

use Attribute;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

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

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new SendVerifyWithQueueNotification());
    }

    public function getRoleName(): string
    {
        return "{$this->getRoleNames()[0]}";
    }

    public function whetherRemoved(): bool
    {
        return $this->deleted_at ? true : false;
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_user_likes', 'user_id', 'post_id');
    }

    public function checkLike(int $postId): bool
    {
        return $this->likedPosts->contains($postId);
    }
}

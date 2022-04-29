<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUserLike extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class, 'like_id', 'user_id', 'id');
    }
}

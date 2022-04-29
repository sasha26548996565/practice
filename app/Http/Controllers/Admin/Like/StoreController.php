<?php

namespace App\Http\Controllers\Admin\Like;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __invoke(Post $post): RedirectResponse
    {
        Auth::user()->likedPosts()->toggle($post->id);

        return to_route('admin.post.index');
    }
}

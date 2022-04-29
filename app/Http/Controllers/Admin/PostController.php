<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Post\Comment\StoreRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.post.index', compact(nameof($posts)));
    }

    public function show(Post $post): View
    {
        return view('admin.post.show', compact(nameof($post)));
    }
}

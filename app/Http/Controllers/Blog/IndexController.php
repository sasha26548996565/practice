<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::latest()->paginate(15);

        return view('blog.index', compact(nameof($posts)));
    }
}

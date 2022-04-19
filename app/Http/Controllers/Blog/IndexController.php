<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $post = Post::findOrFail(1);

        $category = $post->category->title;
        $tags = $post->tags;

        dd($category);
    }
}

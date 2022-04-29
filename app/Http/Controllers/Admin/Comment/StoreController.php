<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Post\Comment\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $post->id;

        Comment::create($data);

        return to_route('admin.post.show', $post->id);
    }
}

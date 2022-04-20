<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    private Collection $data;

    public function __construct()
    {
        $this->data = collect();

        $this->data->put('countTags', Tag::count());
        $this->data->put('countCategories', Category::count());
        $this->data->put('countPosts', Post::count());
        $this->data->put('countUsers', User::count());
    }

    public function __invoke()
    {
        $data = $this->data;

        return view('admin.index', compact(nameof($data)));
    }
}

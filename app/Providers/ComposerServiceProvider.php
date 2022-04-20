<?php

namespace App\Providers;

use App\ViewComposers\TagsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\CategoriesComposer;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('includes.blog.header', TagsComposer::class);
        View::composer('includes.blog.header', CategoriesComposer::class);
    }
}

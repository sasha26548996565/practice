<?php

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoriesComposer implements IComposer
{
    public function compose(View $view)
    {
        return $view->with('categories', Category::latest()->get());
    }
}

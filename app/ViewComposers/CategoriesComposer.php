<?php

declare(strict_types=1);

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoriesComposer implements IComposer
{
    public function compose(View $view): View
    {
        return $view->with('categories', Category::latest()->get());
    }
}

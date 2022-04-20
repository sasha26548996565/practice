<?php

declare(strict_types=1);

namespace App\ViewComposers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;

class TagsComposer implements IComposer
{
    public function compose(View $view): View
    {
        return $view->with('tags', Tag::latest()->get());
    }
}

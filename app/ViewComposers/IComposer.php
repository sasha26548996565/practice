<?php

declare(strict_types=1);

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

interface IComposer
{
    public function compose(View $view): View;
}

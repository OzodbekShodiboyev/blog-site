<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class FooterComposer
{
    public function compose(View $view): void
    {
        $categories = Category::all(); 
        $view->with('categories', $categories);
    }
}

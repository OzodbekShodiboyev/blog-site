<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NavbarComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();
        $categories = Category::all(); 

        $view->with([
            'authUser' => $user,
            'navbarCategories' => $categories,
        ]);
    }
}

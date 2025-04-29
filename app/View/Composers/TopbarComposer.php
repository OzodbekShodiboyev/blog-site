<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TopbarComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();
        $view->with('authUser', $user);
    }
}

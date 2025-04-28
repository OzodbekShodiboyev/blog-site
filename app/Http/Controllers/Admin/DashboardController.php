<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return view('admin.dashboard');
        }else if($user->hasRole('author')) {
            return view('author.dashboard');
        }
    }
}

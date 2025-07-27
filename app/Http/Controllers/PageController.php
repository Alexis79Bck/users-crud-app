<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function usersIndex()
    {
        return Inertia::render(component: 'Users/Index');
    }

    public function postsIndex()
    {
        return Inertia::render(component: 'Posts/Index');
    }
}

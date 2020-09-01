<?php

namespace App\Http\Controllers;

use App\Repositories\Locations\AreaRepositoryInterface;
use App\Repositories\Rpg\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show banned page
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function banned()
    {
        if (! auth()->check())
            return redirect()->route('home');
        $ban = auth()->user()->bans()->active()->first();
        auth()->logout();
        return view('errors.banned', compact('ban'));
    }
}

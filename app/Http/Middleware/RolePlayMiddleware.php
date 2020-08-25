<?php

namespace App\Http\Middleware;

use App\Post;
use App\User;
use Closure;
use App\Area;
use Illuminate\Support\Facades\View;

class RolePlayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('areas', Area::all());
        View::share('lastPosts', Post::orderBy('created_at', 'desc')->limit(5)->get());
        View::share('lastUsers', User::orderBy('created_at', 'desc')->limit(5)->get());
        return $next($request);
    }
}

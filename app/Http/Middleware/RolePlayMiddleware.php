<?php

namespace App\Http\Middleware;

use App\Post;
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
        View::share('fiveLastPosts', Post::orderBy('created_at', 'desc')->limit(5)->get()->toArray());
        return $next($request);
    }
}

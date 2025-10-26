<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route('post');

        if ($post && !auth()->user()->isAdmin() && $post->user_id !== auth()->id()) {
            abort(403, 'You can only edit your own posts');
        }

        return $next($request);
    }
}

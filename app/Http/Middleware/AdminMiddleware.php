<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ստուգում ենք՝ արդյոք օգտատերը մուտք է գործել և նրա դերը 'admin' է
        if (auth()->check() && auth()->user()->role === 'admin' || auth()->check() && auth()->user()->role === 'superadmin') {
            return $next($request);
        }

        // Եթե ադմին չէ, ուղարկում ենք գլխավոր էջ
        return redirect('/')->with('error', 'Access denied.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

        public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_blocked) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Ձեր հաշիվը արգելափակված է ադմինիստրատորի կողմից:'
            ]);
        }

        return $next($request);
    }

}

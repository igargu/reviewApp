<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrationMiddleware {
    
    public function handle(Request $request, Closure $next) {
        $user = Auth::user();
        if ($user != null && $user->isAdmin()) {
            return $next($request);
        }
        return redirect('/');
    }
}

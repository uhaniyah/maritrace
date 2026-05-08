<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // Allow Administrator, Akademik, and Instruktur roles to access admin panel
        if (in_array($user->role, ['Administrator', 'Akademik', 'Instruktur'])) {
            return $next($request);
        }

        Auth::logout();

        return redirect()->route('admin.login')->with('error', 'Anda tidak memiliki akses ke area ini.');
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $privilege)
    {
        $user = Auth::user();

        $user = User::find($user->id);

        if (!$user->hasPrivilege($privilege)) {

            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponder;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    use ApiResponder;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $permission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Super admin (id = 1) has all permissions
        if (Auth::user()->id == 1) {
            return $next($request);
        }

        // Check if the user has the required permission
        if (!Auth::user()->hasPermission($permission)) {
            // If it's an AJAX request, return JSON response
            if ($request->ajax() || $request->wantsJson()) {
                return $this->error('ليس لديك صلاحية للوصول إلى هذه الصفحة',403);
            }

            // Otherwise, redirect back with error message
            return redirect()->back()->with('error', 'ليس لديك صلاحية للوصول إلى هذه الصفحة');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentTenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('currentTenant')) {
            if ($user = Auth::user()) {
                session(['currentTenant' => $user->tenant_id]);
            }
        } else {
            $tenant = Tenant::find(session('currentTenant'));
            if (! $tenant) {
                session()->forget('currentTenant');
                session(['currentTenant' => Auth::user()->tenant_id]);
            }
        }

        return $next($request);
    }
}

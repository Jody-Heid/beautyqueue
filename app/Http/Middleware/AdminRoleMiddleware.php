<?php

namespace App\Http\Middleware;

use Closure;
use Flugg\Responder\Http\MakesResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    use MakesResponses;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (! $request->user()->admin) {

            return $this->error(404, 'Action does not exist')->respond();
        }

        return $next($request);
    }
}

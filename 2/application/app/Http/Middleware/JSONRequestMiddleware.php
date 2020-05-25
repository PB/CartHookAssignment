<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class JSONRequestMiddleware
{
    /**
     * Handle an incoming request.
     * Allow only Content-Type: application/json
     * This middleware should be applied only on API routes
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isJson()) {
            return response()->json([], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        return $next($request);
    }
}

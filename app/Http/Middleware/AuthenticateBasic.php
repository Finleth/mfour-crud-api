<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Response;

class AuthenticateBasic
{
    /**
     * Check for a basic authentication token
     * 
     * Note: This is a super basic authentication system for temporary use.
     *       A proper oauth2 would be implemented/database tables added
     *       should this application be built out further.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return Response::json(['error' => 'No authorization provided.'], 400);
        }

        if ($request->bearerToken() !== config('app.api_key')) {       
            return Response::json(['error' => 'Invalid credentials.'], 401);
        }

        return $next($request);
    }
}
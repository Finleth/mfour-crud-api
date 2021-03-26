<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Response;

class AuthenticateBearer
{
    /**
     * Check for a bearer authentication token
     * 
     * Note: This uses a hard-coded bearer token from the .env file.
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
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

class VerifyApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->headers->has('Authorization'))
        {
            $token = $request->header('Authorization');
        } elseif ($request->has('Authorization')) {
            $token = $request->get('Authorization');
        }

        if(!isset($token) || !DB::table('api_tokens')
            ->where('value', substr($token, 7))
            ->exists())
        {
            throw new UnauthorizedException;
        }

        return $next($request);

    }
}

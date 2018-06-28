<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class RefreshToken extends BaseMiddleware
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

        $this->checkForToken($request);

        try{
            
            // build payload and throws exception when expired
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();

            if (!$this->auth->parseToken()->authenticate()) {
                throw new UnauthorizedHttpException('User not found');
            }
            return $next($request);
        } catch (TokenExpiredException $e) {
            
            // build payload and throws exception when expired
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();

            // Check cache for blocked refresh token
            $key = 'block_refresh_token_for_user_' . $payload['sub']; 
            $cachedBefore = (int) Cache::has($key);

            // If a token alredy was refreshed and sent to the client in the last JWT_BLACKLIST_GRACE_PERIOD seconds.
            if ($cachedBefore) { 
                \Auth::onceUsingId($payload['sub']); // Log the user using id.
                return $next($request); // Token expired. Response without any token because in grace period.
            }

            // Create a new token
            try {
                $newToken = $this->auth->refresh(); // Get new token.
                $gracePeriod = $this->auth->manager()->getBlacklist()->getGracePeriod();
                $expiresAt = Carbon::now()->addSeconds($gracePeriod);
                Cache::put($key, $newtoken, $expiresAt);
            } catch (JWTException $e) {
                throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
            }
        }

        $response = $next($request);

        return $this->setAuthenticationHeader($response, $newToken);

        
    }
}

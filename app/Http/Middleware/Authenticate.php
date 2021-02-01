<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next,...$guards)
    {
        //Check Guard Defned
        $this->authenticate($request, $guards);

        //Check User is Active
        if ($request->user()->is_active != 1)
        {
            $error = '<div style="display: flex;justify-content: center;align-items: center;height: 100vh;flex-direction: column">
                        <h1 style="color: #ff0000">You have not an active account</h1>
                        <a href="'.route('home').'">Go Back</a>
                    </div>';
            return response($error, 401);
        }

        return $next($request);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}

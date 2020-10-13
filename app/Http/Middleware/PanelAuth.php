<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;
class PanelAuth
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
        if (Auth::check()) {
            return $next($request);
        }else{
            //return Response::make(view('errors.404'), 404);
            return Response::make(view("panel.auth.login"),200);
        }
        
    }
}

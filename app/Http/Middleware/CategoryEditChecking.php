<?php

namespace App\Http\Middleware;

use Closure;

class CategoryEditChecking
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
        /*session_start();
        if(isset($_SESSION['idItem']) && !empty($_SESSION['idItem'])) {
            
        }else{
            return $next($request);
        } */     
        return $next($request);  
    }
}

<?php 
namespace App\Http\Middleware;
use Closure;
use Sentinel;
use Redirect;
use Request;

class SentinelAdmin {
    public function handle($request, Closure $next) {
        if(!Sentinel::check()) {
            $url = Request::segment(1);
            return Redirect::to($url.'/login');
        } else {
        	if(Sentinel::inRole('admin') || Sentinel::check()->role == "Admin"){
        		return $next($request);		
            }
            
            $url = Request::segment(1);
        	return Redirect::to($url.'/login');
        }
    }
}
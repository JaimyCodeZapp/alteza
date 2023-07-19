<?php
 
namespace App\Http\Middleware;
 
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class CheckRolePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $permission): Response
    {
        if (!Auth::user()->hasPermissionTo($permission)) {
            if(Auth::user()->hasPermissionTo('admin')) return to_route('dashboard');
            return to_route('home');
        }
 
        return $next($request);
    }
}
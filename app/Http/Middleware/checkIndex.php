<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class checkIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->session()->exists('admin')){
            return redirect()->route('admin.cms.home');
        }

        if($request->session()->exists('manager')){
            return redirect()->route('manager.cms.home');
        }

        return $next($request);
    }
}

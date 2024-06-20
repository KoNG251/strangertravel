<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Chunk;
use App\Models\Hotel;

class checkChunks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $chunks = Chunk::where('user','=',session('user'))->count();
        if($chunks != 0){
            return redirect()->route('manager.check.chunks');
        }

        $details = Hotel::where('createId','=',session('user'))->where('hotelName','=',null)->count();
        if($details != 0){
            return redirect()->route('manager.viewDetails');
        }

        return $next($request);
    }
}

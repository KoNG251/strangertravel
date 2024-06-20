<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Chunk;

class Chunks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $chunks = Chunk::where('user','=',session('user'))->count();
        if($chunks == 0){
            return redirect()->route('manager.add');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleApiFileUploads
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('POST') && $request->hasFile('image')) {
            $request->headers->set('Content-Type', 'multipart/form-data');
        }

        return $next($request);
    }
}

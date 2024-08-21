<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\GeneratePin;

class FormDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $latestPinRecord = GeneratePin::orderBy('created_at', 'desc')->first();

        if($latestPinRecord && $latestPinRecord->status === 'inactive'){
            return redirect()->route('pinScreening');
        }
        return $next($request);
    }
}

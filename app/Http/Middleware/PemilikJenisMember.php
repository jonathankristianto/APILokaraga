<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\jenismember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikJenisMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = Auth::user();
        $jenismember = jenismember::findOrFail($request->id);

        if ($jenismember->user_id != $currentUser->id) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return $next($request);
    }
}

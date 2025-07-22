<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikUser
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
        $user = user::findOrFail($request->id);

        if ($user->id != $currentUser->id) {
            return response()->json(['message' => 'data not found'], 403);
        }

        return $next($request);
    }
}

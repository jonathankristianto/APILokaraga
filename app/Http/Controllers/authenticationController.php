<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class authenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required',
        ]);

        $user = user::where('email', $request->email)->first();

        if(! $user || ! Hash::check($request->kata_sandi, $user->kata_sandi)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('user login')->plainTextToken;
    }  

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function profile(Request $request)
    {
        return response()->json(Auth()->user());
    }
}

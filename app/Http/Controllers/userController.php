<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $user = user::all()->load('role');
        return userResource::collection($user);
    }

    public function show($id)
    {
        $user = user::findOrfail($id);
        $user->load('role');
        return new userResource($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|max:100',
            'kata_sandi' => 'required|max:100',
            'no_telp' => 'required|max:12',
            'role_id' => 'required|exists:role,id',
        ]);

        $role = role::where('nama_role', 'Pemilik')->first();

        $user = user::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'kata_sandi' => Hash::make($validated['kata_sandi']),
            'no_telp' => $validated['no_telp'],
            'role_id' => $role->id,
        ]);

        //$request['user_id'] = Auth::user()->id;
        //$user = user::create($request->all());
        return new userResource ($user->loadMissing('role'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|max:100',
            'kata_sandi' => 'required|max:100',
            'no_telp' => 'required|max:12',
        ]);

        $user = user::findOrfail($id);
        $user->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'kata_sandi' => Hash::make($validated['kata_sandi']),
            'no_telp' => $validated['no_telp'],
        ]);

        return new userResource ($user->loadMissing('role'));
    }

    public function destroy($id)
    {
        $user = user::findOrfail($id);
        $user->delete();

        return new userResource ($user->loadMissing('role'));
    }
}

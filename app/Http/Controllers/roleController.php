<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use App\Http\Resources\roleResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\roleDetailResource;

class roleController extends Controller
{
    public function index()
    {
        $role = role::all();
        return roleResource::collection($role);
    }

    public function show($id)
    {
        $role = role::findOrfail($id);
        return new roleResource($role);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => 'required|max:255',
        ]);

        $role = role::create($request->all());
        return new roleResource ($role);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenisolahraga;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\jenisolahragaResource;
use App\Http\Resources\jenisolahragaDetailResource;

class jenisolahragaController extends Controller
{
    public function index()
    {
        $jenisolahraga = jenisolahraga::all();
         return jenisolahragaResource::collection($jenisolahraga);
    }

    public function show($id)
    {
        $jenisolahraga = jenisolahraga::findOrfail($id);
        return new jenisolahragaResource($jenisolahraga);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nm_jenisolahraga' => 'required|max:100',
        ]);

        $request['user_id'] = Auth::user()->id;
        $jenisolahraga = jenisolahraga::create($request->all());
        return new jenisolahragaResource ($jenisolahraga);
    }
}

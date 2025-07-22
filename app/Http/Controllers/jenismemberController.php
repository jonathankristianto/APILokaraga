<?php

namespace App\Http\Controllers;

use App\Models\jenismember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\jenismemberResource;
use App\Http\Resources\jenismemberDetailResource;

class jenismemberController extends Controller
{
    public function index()
    {
        $jenismember = jenismember::all();
         return jenismemberResource::collection($jenismember);
    }

    public function show($id)
    {
        $jenismember = jenismember::findOrfail($id);
        return new jenismemberResource($jenismember);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nm_membership' => 'required|max:100',
            'masa_berlaku' => 'required|max:20',
            'harga' => 'required|max:100',
            'deskripsi' => 'required',
            'user_id' => 'required|exists:user,id'
        ]);

        $request['user_id'] = Auth::user()->id;
        $jenismember = jenismember::create($request->all());
        return new jenismemberResource ($jenismember->loadMissing('user'));
    }

    //ini fungsi edit jenis member
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nm_membership' => 'required|max:100',
            'masa_berlaku' => 'required|max:20',
            'harga' => 'required|max:100',
            'deskripsi' => 'required',
            'user_id' => 'required|exists:user,id'
        ]);

        $jenismember = jenismember::findOrfail($id);
        $jenismember->update($request->all());

        return new jenismemberResource ($jenismember->loadMissing('user'));
    }

    public function destroy($id)
    {
        $jenismember = jenismember::findOrfail($id);
        $jenismember->member()->delete();
        $jenismember->delete();

        return new jenismemberResource ($jenismember->loadMissing('user'));
    }
}

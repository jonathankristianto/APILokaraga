<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\memberResource;
use App\Http\Resources\memberDetailResource;

class memberController extends Controller
{
    public function index()
    {
        $member = member::all()->load('user','jenismember');
         return memberResource::collection($member);
    }

    public function show($id)
    {
        $member = member::findOrfail($id);
        $member->load('user','jenismember');
        return new memberResource($member);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'user_id' => 'required|exists:user,id',
            'jenismember_id' => 'required|exists:jenis_member,id',
        ]);

        //$request['user_id'] = Auth::user()->id;
        $member = member::create($request->all());
        return new memberResource ($member->loadMissing('user','jenismember'));
    }
}

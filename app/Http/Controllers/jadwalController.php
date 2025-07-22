<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\jadwalResource;
use App\Http\Resources\jadwalDetailResource;

class jadwalController extends Controller
{
    public function index()
    {
        $jadwal = jadwal::all()->load('lapangan');
        return jadwalResource::collection($jadwal);
    }

    public function show($id)
    {
        $jadwal = jadwal::findOrfail($id);
        $jadwal->load('lapangan');
        return new jadwalResource($jadwal);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'lapangan_id' => 'required'
        ]);

        $request['user_id'] = Auth::user()->id;
        $jadwal = jadwal::create($request->all());
        return new jadwalResource ($jadwal->loadMissing('lapangan'));
    }
}

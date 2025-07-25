<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use Illuminate\Http\Request;
use App\Http\Resources\pesananResource;
use App\Http\Resources\pesananDetailResource;
use Illuminate\Support\Facades\Auth;
use App\Models\jadwal;
use App\Models\lapangan;

class pesananController extends Controller
{
    public function index()
    {
        $pesanan = pesanan::all()->load('user','lapangan','jadwal');
        return response()->json([
            "data" => pesananResource::collection($pesanan),
        ]);
    }

    public function show($id)
    {
        $pesanan = pesanan::where('id', $id)->first();

        if ($pesanan == null) {
            return response()->json([
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }
        return new pesananResource($pesanan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal' => 'required|date',
        ]);

        $jadwal = jadwal::findOrfail($validated['jadwal_id']);
        $lapangan = lapangan::findOrfail($validated['lapangan_id']);
        $pesanan = pesanan::where('jadwal_id', $validated['jadwal_id'])->where('tanggal', $validated['tanggal'])->where('lapangan_id', $validated['lapangan_id'])->first();

        if ($pesanan) {
            return response()->json([
                'message' => 'Lapangan sudah dipesan'
            ], 400);
        }

        $request['user_id'] = Auth::user()->id;
        $request['tanggal'] = $validated['tanggal'];
        $request['jam_mulai'] = $jadwal->jam_mulai;
        $request['jam_selesai'] = $jadwal->jam_selesai;
        $request['total_harga'] = $lapangan->harga;
        $pesanan = pesanan::create($request->all());
        return new pesananResource($pesanan);
    }
}

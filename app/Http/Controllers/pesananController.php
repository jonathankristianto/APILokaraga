<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use Illuminate\Http\Request;
use App\Http\Resources\pesananResource;
use App\Http\Resources\pesananDetailResource;

class pesananController extends Controller
{
    public function index()
    {
        $pesanan = pesanan::all()->load('user','promo','lapangan','jadwal');
        return response()->json([
            "data" => pesananResource::collection($pesanan),
        ]);
        //pesananResource::collection($pesanan);
    }

    public function show($id)
    {
        $pesanan = pesanan::findOrfail($id);
        return new pesananResource($pesanan);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\lapanganResource;
use App\Http\Resources\lapanganDetailResource;

class lapanganController extends Controller
{
    public function index()
    {
        $lapangan = lapangan::all()->load('jenisolahraga','user');
        return lapanganResource::collection($lapangan);
    }

    public function show($id)
    {
        $lapangan = lapangan::findOrfail($id);
        return new lapanganResource ($lapangan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nm_lapangan' => 'required|max:100',
            'alamat' => 'required|max:255',
            'harga' => 'required|max:100',
            'fasilitas' => 'required',
            'jam_buka_operasional' => 'required|date_format:H:i',
            'jam_tutup_operasional' => 'required|date_format:H:i',
            'user_id' => 'required|exists:user,id',
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
        ]);

        $foto = '';
        if ($request->file) {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $foto = $fileName.'.'.$extension;

            Storage::putFileAs('foto', $request->file, $foto);
        }

        $request['foto'] = $foto;
        $request['user_id'] = Auth::user()->id;
        $lapangan = lapangan::create($request->all());
        return new lapanganResource ($lapangan->loadMissing('jenisolahraga','user'));
    }

    public function update(Request $request, $id) 
    {
        $validated = $request->validate([
            'nm_lapangan' => 'required|max:100',
            'alamat' => 'required|max:255',
            'harga' => 'required|max:100',
            'fasilitas' => 'required',
            'jam_buka_operasional' => 'required|date_format:H:i',
            'jam_tutup_operasional' => 'required|date_format:H:i',
            'user_id' => 'required|exists:user,id',
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
        ]);

        $lapangan = lapangan::findOrfail($id);
        $lapangan->update($request->all());

        return new lapanganResource ($lapangan->loadMissing('jenisolahraga','user'));
    }

    public function destroy($id)
    {
        $lapangan = lapangan::findOrfail($id);
        $lapangan->delete();

        return new lapanganResource ($lapangan->loadMissing('jenisolahraga','user'));
    }

    function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}
}
<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\DokumentasiFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $diklat = Diklat::select('id_diklat', 'foto', 'nama_diklat', 'tgl_mulai', 'tgl_selesai')
                    ->where('foto', '!=', '')
                    ->orderBy('tgl_mulai', 'desc')
                    ->get();

        // Debug sebelum return view untuk memastikan data ada
        // dd($diklat);
                    
        return view('content.cards.foto-diklat', compact('diklat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_diklat' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $foto = $request->file('foto');
        $fotoName = time() . '_' . $foto->getClientOriginalName();
        $foto->storeAs('public/foto_diklat', $fotoName);

        DokumentasiFoto::create([
            'nama_diklat' => $request->nama_diklat,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'foto' => $fotoName
        ]);

        return redirect()->route('dokumentasi.foto')->with('success', 'Foto diklat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_diklat' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dokumentasi = DokumentasiFoto::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($dokumentasi->foto) {
                Storage::delete('public/foto_diklat/' . $dokumentasi->foto);
            }
            
            // Upload foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto_diklat', $fotoName);
            $dokumentasi->foto = $fotoName;
        }

        $dokumentasi->nama_diklat = $request->nama_diklat;
        $dokumentasi->tgl_mulai = $request->tgl_mulai;
        $dokumentasi->tgl_selesai = $request->tgl_selesai;
        $dokumentasi->save();

        return redirect()->route('dokumentasi.foto')->with('success', 'Foto diklat berhasil diperbarui');
    }
}
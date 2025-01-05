<?php

namespace App\Http\Controllers;

use App\Models\PesertaDiklat;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Mendapatkan data peserta berdasarkan ID diklat
    public function getPesertaByDiklat($id_diklat)
    {
        $peserta = PesertaDiklat::where('diklat_id', $id_diklat)->get();
        return response()->json($peserta);
    }

    // Mengupdate status peserta (Lulus/Belum Lulus)
    public function updateStatus(Request $request, $id_peserta)
    {
        $peserta = PesertaDiklat::findOrFail($id_peserta);
        $peserta->status = $request->input('status');
        $peserta->save();
        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }

    // Menghapus data peserta
    public function destroy($id_peserta)
    {
        $peserta = PesertaDiklat::findOrFail($id_peserta);
        $peserta->delete();
        return response()->json(['success' => true, 'message' => 'Peserta berhasil dihapus.']);
    }

}

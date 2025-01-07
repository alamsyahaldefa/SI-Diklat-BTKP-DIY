<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\PesertaDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $diklat = Diklat::where('status', 1);

        if ($query) {
            $diklat->where(function ($q) use ($query) {
                $q->where('nama_diklat', 'like', "%{$query}%")
                    ->orWhere('deskripsi', 'like', "%{$query}%");
            });
        }

        $diklat = $diklat->paginate(10);
        return view('content.tables.diklat', compact('diklat'));
    }

    public function pesertaLolos($id)
    {
        $diklat = Diklat::findOrFail($id);
        $pesertaLolos = PesertaDiklat::with('user')
            ->where('id_diklat', $id)
            ->where('status', 1)
            ->get();

        return view('content.tables.peserta-lolos', compact('diklat', 'pesertaLolos'));
    }

    public function pesertaMendaftar($id)
    {
        $diklat = Diklat::findOrFail($id);
        $pesertaMendaftar = PesertaDiklat::with('user')
            ->where('id_diklat', $id)
            ->where('status', 0)
            ->get();

        return view('content.tables.peserta-mendaftar', compact('diklat', 'pesertaMendaftar'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_diklat' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'kuota' => 'required|integer|min:1',
            'syarat' => 'nullable|string',
            'surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated = array_merge($validated, [
            'status' => 1,
            'pengumuman' => 1,
            'quiz' => 0,
            'komunitas' => 0,
            'link' => '',
            'surat' => '',
            'foto' => ''
        ]);

        if ($request->hasFile('surat')) {
            $validated['surat'] = $this->handleFileUpload($request, 'surat', 'surat_diklat');
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->handleFileUpload($request, 'foto', 'foto_diklat');
        }

        Diklat::create($validated);

        return redirect()->route('data-diklat')->with('success', 'Diklat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $diklat = Diklat::findOrFail($id);

        $validated = $request->validate([
            'nama_diklat' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'kuota' => 'required|integer|min:1',
            'syarat' => 'nullable|string',
            'status' => 'boolean',
            'surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('surat')) {
            $validated['surat'] = $this->handleFileUpload($request, 'surat', 'surat_diklat', $diklat->surat);
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->handleFileUpload($request, 'foto', 'foto_diklat', $diklat->foto);
        }

        $diklat->update($validated);

        return redirect()->route('data-diklat')->with('success', 'Diklat berhasil diperbarui');
    }

    public function updateStatus($id, $status)
    {
        $diklat = Diklat::findOrFail($id);
        $diklat->status = $status;
        $diklat->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function updateStatusPeserta(Request $request, $id_peserta)
    {
        try {
            $peserta = PesertaDiklat::findOrFail($id_peserta);
            $peserta->status = $request->status;
            $peserta->save();

            $message = $peserta->status == 1
                ? 'Peserta berhasil diterima ke daftar lolos.'
                : 'Peserta berhasil dikembalikan ke daftar pendaftar.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error("Error updating peserta status: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleField($id, $field)
    {
        $allowedFields = ['pengumuman', 'quiz', 'komunitas'];
        
        if (!in_array($field, $allowedFields)) {
            return response()->json(['success' => false, 'message' => 'Field tidak valid'], 400);
        }

        try {
            $diklat = Diklat::findOrFail($id);
            $diklat->$field = !$diklat->$field;
            $diklat->save();

            return response()->json([
                'success' => true,
                'message' => ucfirst($field) . ' berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error("Error toggling field: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data'
            ], 500);
        }
    }

    public function rekapData($id)
    {
        try {
            Log::info("Accessing rekapData for diklat ID: $id");

            $diklat = Diklat::findOrFail($id);
            
            $pesertaLolos = PesertaDiklat::with('user')
                ->where('id_diklat', $id)
                ->where('status', 1)
                ->get();

            $pesertaMendaftar = PesertaDiklat::with('user')
                ->where('id_diklat', $id)
                ->where('status', 0)
                ->get();

            return view('content.tables.rekap-data', compact('diklat', 'pesertaLolos', 'pesertaMendaftar'));
        } catch (\Exception $e) {
            Log::error("Error in rekapData: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function togglePesertaStatus($id)
    {
        try {
            Log::info("Toggling status for peserta ID: $id");

            $peserta = PesertaDiklat::findOrFail($id);
            Log::info("Current status: " . $peserta->status);

            $peserta->status = $peserta->status == 0 ? 1 : 0;
            $peserta->save();

            Log::info("New status: " . $peserta->status);

            $statusText = $peserta->status == 1 ? 'peserta lolos' : 'peserta mendaftar';
            return response()->json([
                'success' => true,
                'message' => "Status berhasil diubah menjadi $statusText"
            ]);
        } catch (\Exception $e) {
            Log::error("Error toggling status: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $diklat = Diklat::findOrFail($id);
        return view('content.form-layout.edit-diklat', compact('diklat'));
    }

    public function destroy($id)
    {
        try {
            $diklat = Diklat::findOrFail($id);
            $diklat->delete();

            return redirect()->route('data-diklat')->with('success', 'Diklat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('data-diklat')->with('error', 'Terjadi kesalahan saat menghapus diklat.');
        }
    }

    private function handleFileUpload($request, $inputName, $path, $oldFile = null)
    {
        if ($request->hasFile($inputName)) {
            if ($oldFile) {
                Storage::disk('public')->delete("$path/$oldFile");
            }
            
            $file = $request->file($inputName);
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs("public/$path", $fileName);
            
            return $fileName;
        }
        
        return $oldFile;
    }

    public function showForUser()
    {
        $diklat = Diklat::where('status', 1)->get();
        return view('user.main', compact('diklat'));
    }

    public function batalkanPeserta($id)
    {
        try {
            $peserta = PesertaDiklat::findOrFail($id);
            $peserta->status = 'mendaftar';
            $peserta->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Error membatalkan peserta: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membatalkan peserta'
            ], 500);
        }
    }

    public function updateSertifikat($id)
    {
        try {
            $peserta = PesertaDiklat::findOrFail($id);
            $peserta->sertifikat_diambil = true;
            $peserta->tanggal_ambil_sertifikat = now();
            $peserta->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Error updating sertifikat: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status sertifikat'
            ], 500);
        }
    }
    public function fotoDiklat()
    {
        try {
            Log::info('Fungsi fotoDiklat dipanggil');
            
            $diklat = Diklat::select('id_diklat', 'nama_diklat', 'tgl_mulai', 'tgl_selesai', 'foto')
                        ->orderBy('tgl_mulai', 'desc')
                        ->get();
            
            Log::info('Data count: ' . $diklat->count());
            
            return view('content.cards.foto-diklat', ['diklat' => $diklat]);
    
        } catch (\Exception $e) {
            Log::error('Error in fotoDiklat: ' . $e->getMessage());
            return view('content.cards.foto-diklat', ['diklat' => collect()]);
        }
    }

    public function updateFoto(Request $request, $id)
    {
        try {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $diklat = Diklat::findOrFail($id);
            
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada di storage
                if ($diklat->foto && Storage::disk('public')->exists('foto_diklat/' . $diklat->foto)) {
                    Storage::disk('public')->delete('foto_diklat/' . $diklat->foto);
                }
                
                // Upload foto baru
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/foto_diklat', $fileName);
                
                // Update database
                $diklat->foto = $fileName;
                $diklat->save();
            }

            return redirect()->back()->with('success', 'Foto berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui foto: ' . $e->getMessage());
        }
    }
}
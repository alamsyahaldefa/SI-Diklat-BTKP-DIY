<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\PesertaDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
{
    public function index(Request $request) {
        // Fix query building - current code reassigns $diklat
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
            ->where('status', 1) // Peserta lolos
            ->get();
    
        return view('content.tables.peserta-lolos', compact('diklat', 'pesertaLolos'));
    }
    
    public function pesertaMendaftar($id)
    {
        $diklat = Diklat::findOrFail($id);
        $pesertaMendaftar = PesertaDiklat::with('user')
            ->where('id_diklat', $id)
            ->where('status', 0) // Peserta mendaftar
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

        $validated['surat'] = $this->handleFileUpload($request, 'surat', 'surat_diklat');
        $validated['foto'] = $this->handleFileUpload($request, 'foto', 'foto_diklat');

        $validated += [
            'status' => 1,
            'pengumuman' => 1,
            'quiz' => 0,
            'komunitas' => 0,
            'link' => '',
        ];

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

        $validated['surat'] = $this->handleFileUpload($request, 'surat', 'surat_diklat', $diklat->surat);
        $validated['foto'] = $this->handleFileUpload($request, 'foto', 'foto_diklat', $diklat->foto);

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

            // Update status berdasarkan input request
            $peserta->status = $request->status;
            $peserta->save();

            return response()->json([
                'success' => true,
                'message' => $peserta->status == 1 
                    ? 'Peserta berhasil diterima ke daftar lolos.' 
                    : 'Peserta berhasil dikembalikan ke daftar pendaftar.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function toggleField($id, $field)
    {
        $diklat = Diklat::findOrFail($id);

        if (!in_array($field, ['pengumuman', 'quiz'])) {
            return response()->json(['success' => false, 'message' => 'Field tidak valid'], 400);
        }

        $diklat->$field = !$diklat->$field;
        $diklat->save();

        return response()->json(['success' => true, 'message' => ucfirst($field) . ' berhasil diperbarui']);
    }

    public function rekapData($id)
    {
        try {
            Log::info("Accessing rekapData for diklat ID: $id"); // Debug log
            
            $diklat = Diklat::findOrFail($id);
            
            // Get peserta lolos
            $pesertaLolos = PesertaDiklat::with('user')
                ->where('id_diklat', $id)
                ->where('status', 1)
                ->get();
                
            Log::info("Peserta Lolos count: " . $pesertaLolos->count()); // Debug log
            Log::info("Peserta Lolos Data: ", $pesertaLolos->toArray());
            
            // Get peserta mendaftar
            $pesertaMendaftar = PesertaDiklat::with('user')
                ->where('id_diklat', $id)
                ->where('status', 0)
                ->get();
                
            Log::info("Peserta Mendaftar count: " . $pesertaMendaftar->count()); // Debug log
            Log::info("Peserta Mendaftar Data: ", $pesertaMendaftar->toArray());
            
            // Debug log details of each peserta
            foreach($pesertaLolos as $p) {
                Log::info("Lolos - ID: {$p->id_peserta}, Status: {$p->status}, NIK: {$p->nik}");
            }
            
            foreach($pesertaMendaftar as $p) {
                Log::info("Mendaftar - ID: {$p->id_peserta}, Status: {$p->status}, NIK: {$p->nik}");
            }
            
            return view('content.tables.rekap-data', compact('diklat', 'pesertaLolos', 'pesertaMendaftar'));
        } catch (\Exception $e) {
            Log::error("Error in rekapData: " . $e->getMessage()); // Debug log
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function togglePesertaStatus($id)
    {
        try {
            Log::info("Toggling status for peserta ID: $id"); // Debug log
            
            $peserta = PesertaDiklat::findOrFail($id);
            Log::info("Current status: " . $peserta->status); // Debug log
            
            // Toggle status
            $peserta->status = $peserta->status == 0 ? 1 : 0;
            $peserta->save();
            
            Log::info("New status: " . $peserta->status); // Debug log
    
            $statusText = $peserta->status == 1 ? 'peserta lolos' : 'peserta mendaftar';
            return response()->json([
                'success' => true,
                'message' => "Status berhasil diubah menjadi $statusText"
            ]);
    
        } catch (\Exception $e) {
            Log::error("Error toggling status: " . $e->getMessage()); // Debug log
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
            if ($oldFile && file_exists(storage_path("app/public/$path/$oldFile"))) {
                unlink(storage_path("app/public/$path/$oldFile"));
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
    $peserta = PesertaDiklat::findOrFail($id);
    $peserta->status = 'mendaftar';
    $peserta->save();
    
    return response()->json(['success' => true]);
}

public function updateSertifikat($id)
{
    $peserta = PesertaDiklat::findOrFail($id);
    $peserta->sertifikat_diambil = true;
    $peserta->tanggal_ambil_sertifikat = now();
    $peserta->save();
    
    return response()->json(['success' => true]);
}


}

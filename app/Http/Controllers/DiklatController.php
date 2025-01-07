<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\PesertaDiklat;
use Illuminate\Http\Request;
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


    public function pesertaLolos()
    {
        return $this->hasMany(PesertaDiklat::class)->where('status', 'lolos');
    }

    public function pesertaMendaftar() 
    {
        return $this->hasMany(PesertaDiklat::class)->where('status', 'mendaftar');
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

    public function updatePesertaStatus($id_diklat, $id_peserta)
    {
        $peserta = PesertaDiklat::findOrFail($id_peserta);
        $peserta->status = 'lolos';
        $peserta->save();
        
        return response()->json(['success' => true]);
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
    $diklat = Diklat::findOrFail($id);
    
    $pesertaLolos = PesertaDiklat::with('user')
        ->where('id_diklat', $id)
        ->where('status', 'lolos')
        ->get();
        
    $pendaftarBaru = PesertaDiklat::with('user')
        ->where('id_diklat', $id)
        ->where('status', 'mendaftar')
        ->get();
    
    return view('content.tables.rekap-data', [
        'diklat' => $diklat,
        'pesertaLolos' => $pesertaLolos,
        'pendaftarBaru' => $pendaftarBaru
    ]);
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

public function togglePesertaStatus($id)
{
    $peserta = PesertaDiklat::findOrFail($id);
    $peserta->status = $peserta->status === 'mendaftar' ? 'lolos' : 'mendaftar';
    $peserta->save();
    
    return response()->json(['success' => true]);
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

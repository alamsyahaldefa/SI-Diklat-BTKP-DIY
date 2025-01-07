<?php
namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Diri;
use App\Models\PesertaDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DaftarController extends Controller
{
    private function convertJenjangToInt($jenjang) 
    {
        $mapping = [
            'TK' => 1,
            'PAUD' => 1,
            'SD' => 2,
            'SMP' => 3,
            'SMA' => 4,
            'SMAN' => 6,
            'SMK' => 8,
            'SMKN' => 8
        ];

        return $mapping[strtoupper($jenjang)] ?? 5; // default to 5 (Lainnya) if not found
    }

    private function convertJenjangToString($jenjangInt) 
    {
        $mapping = [
            1 => 'TK/PAUD',
            2 => 'SD',
            3 => 'SMP',
            4 => 'SMA',
            5 => 'Lainnya',
            6 => 'SMAN',
            8 => 'SMKN'
        ];

        return $mapping[$jenjangInt] ?? 'Lainnya';
    }

    public function index($id = null)
    {
        try {
            $diklat = Diklat::findOrFail($id);
            session(['diklat_id' => $id]);
            return view('users.daftar', compact('diklat'));
        } catch (\Exception $e) {
            Log::error('Error in index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Diklat tidak ditemukan');
        }
    }

    public function cekNik($nik)
    {
        try {
            if (strlen($nik) !== 16) {
                return response()->json([
                    'error' => true,
                    'message' => 'NIK harus 16 digit'
                ]);
            }

            $diklatId = session('diklat_id');
            $existingRegistration = PesertaDiklat::where('nik', $nik)
                ->where('id_diklat', $diklatId)
                ->exists();

            if ($existingRegistration) {
                return response()->json([
                    'error' => true,
                    'message' => 'Anda sudah terdaftar untuk diklat ini'
                ]);
            }

            $dataDiri = Diri::where('nik', $nik)
                ->where('batal', 0)
                ->first();

            if (!$dataDiri) {
                return response()->json([
                    'error' => true,
                    'message' => 'NIK tidak ditemukan dalam database, akan diarahkan ke form pengisian data'
                ]);
            }

            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            Log::error('Error in cekNik: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    public function formDaftar(Request $request)
    {
        try {
            // Validasi input yang diperlukan
            if (!$request->has('nik') || !$request->has('id_diklat')) {
                return redirect()->back()->with('error', 'Data tidak lengkap');
            }

            $nik = $request->input('nik');
            $diklatId = $request->input('id_diklat');

            // Ambil data diklat
            $diklat = Diklat::findOrFail($diklatId);

            // Cek apakah sudah terdaftar
            $existingRegistration = PesertaDiklat::where('nik', $nik)
                ->where('id_diklat', $diklatId)
                ->exists();

            if ($existingRegistration) {
                return redirect()->back()->with('error', 'Anda sudah terdaftar untuk diklat ini');
            }

            // Cari data diri berdasarkan NIK
            $dataDiri = Diri::where('nik', $nik)
                ->where('batal', 0)
                ->first();

            // Jika data tidak ditemukan, buat instance baru
            if (!$dataDiri) {
                $dataDiri = new Diri();
                $dataDiri->nik = $nik;
            } else {
                // Jika data ditemukan, konversi jenjang ke string
                $dataDiri->jenjang_str = $this->convertJenjangToString($dataDiri->jenjang);
            }

            // Debug untuk memastikan data
            Log::info('Data Diri:', ['dataDiri' => $dataDiri, 'nik' => $nik]);

            return view('users.form-daftar', [
                'dataDiri' => $dataDiri,
                'diklat' => $diklat
            ]);

        } catch (\Exception $e) {
            Log::error('Error in formDaftar: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $diklatId = $request->id_diklat;
            $nik = $request->nik;

            // Validasi input
            $request->validate([
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required|date',
                'pangkat' => 'nullable',
                'golongan' => 'nullable',
                'telp' => 'required',
                'email' => 'required|email',
                'sekolah' => 'required',
                'jabatan' => 'required',
                'jenjang' => 'required|in:TK,PAUD,SD,SMP,SMA,SMAN,SMK,SMKN',
                'kab' => 'required|integer|min:0|max:5', // Add kabupaten validation
                'identitas' => 'required|integer|in:0,1,2', // Add identitas validation
                'nip' => 'nullable',
                'nuptk' => 'nullable',
            ]);

            // Check if already registered again (double check)
            $existingRegistration = PesertaDiklat::where('nik', $nik)
                ->where('id_diklat', $diklatId)
                ->exists();

            if ($existingRegistration) {
                throw new \Exception('Anda sudah terdaftar untuk diklat ini');
            }

            // Convert jenjang string to integer
            $jenjangInt = $this->convertJenjangToInt($request->jenjang);

            // Check if NIK exists in database
            $existing = Diri::where('nik', $nik)->where('batal', 0)->first();

            if (!$existing) {
                // Create new record if NIK doesn't exist
                $insertData = [
                    'nik' => $nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'identitas' => $request->identitas,
                    'nip' => $request->nip ?? '',
                    'nuptk' => $request->nuptk ?? '',
                    'pangkat' => $request->pangkat ?? '',
                    'golongan' => $request->golongan ?? '',
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'sekolah' => $request->sekolah,
                    'jabatan' => $request->jabatan,
                    'jenjang' => $jenjangInt,
                    'kab' => intval($request->kab),
                    'batal' => 0
                ];

                Diri::create($insertData);
            }

            // Create peserta diklat record
            PesertaDiklat::create([
                'nik' => $nik,
                'id_diklat' => $diklatId,
                'status' => 0,
                'sertifikat' => 0,
                'tgl' => now()
            ]);

            DB::commit();
            return redirect()->route('users.index-u')
                ->with('success', 'Pendaftaran berhasil dilakukan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in store: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
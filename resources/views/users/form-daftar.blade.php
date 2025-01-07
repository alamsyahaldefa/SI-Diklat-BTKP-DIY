@extends('layouts.commonMaster')

@section('layoutContent')
    <!-- Laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafc;
        color: #333;
    }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .form-container {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

    .btn-submit {
        background-color: #007bff;
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 50px;
        transition: background 0.3s, box-shadow 0.3s;
        width: 100%;
    }

        .btn-submit:hover {
            background-color: whitesmoke;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h3 {
            font-size: 1.5rem;
            color: #333;
        }
    </style>

@include('layouts.sections.navbar.navbar-user')

    <body>
        <div class="container py-5">
            <h1 class="text-center mb-4">{{ isset($dataDiri->nama) ? 'KONFIRMASI DATA DIRI' : 'PENGISIAN DATA DIRI' }}</h1>

            <!-- User Display -->
            <div class="container mt-5 mb-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="rounded-circle border d-flex justify-content-center align-items-center"
                             style="width: 60px; height: 60px; background-color: #f1f1f1;">
                            <i class='bx bx-user' style="font-size: 2rem; color: #6c757d;"></i>
                        </div>
                    </div>
                    <div class="col mt-1">
                        <h3 class="mb-0 fw-bold">{{ $dataDiri->nama ?? 'Peserta Baru' }}</h3>
                        <p class="text-muted mb-0">NIK: {{ $dataDiri->nik }}</p>
                    </div>
                </div>
            </div>

            <!-- Alert Section -->
            <div class="alert alert-secondary mb-4" role="alert">
                <strong>Perhatian:</strong>
                <ul class="mb-0">
                    @if(isset($dataDiri->nama))
                        <li>Mohon periksa kembali data diri anda sebelum melakukan pendaftaran.</li>
                        <li>Pastikan data yang ditampilkan sudah sesuai dan benar.</li>
                        <li>Jika ada kesalahan data, silahkan hubungi admin.</li>
                    @else
                        <li>Mohon isi data diri anda dengan lengkap dan benar.</li>
                        <li>Pastikan semua field terisi dengan data yang valid.</li>
                        <li>Data yang diinput akan disimpan untuk pendaftaran diklat selanjutnya.</li>
                    @endif
                </ul>
            </div>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Section -->
            <div class="row">
                <div class="col-md-12 form-container">
                    <h4 class="mb-4 text-center">Detail Data Diri</h4>
                    <form action="{{ route('form.daftar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nik" value="{{ $dataDiri->nik }}">
                        <input type="hidden" name="id_diklat" value="{{ $diklat->id_diklat }}">

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nama Lengkap</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(DISARANKAN MENGGUNAKAN GELAR)</span>
                                <input type="text" name="nama" class="form-control" value="{{ $dataDiri->nama ?? '' }}" {{ isset($dataDiri->nama) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ $dataDiri->tempat_lahir ?? '' }}" {{ isset($dataDiri->tempat_lahir) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Tanggal Lahir</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(HARI/BULAN/TAHUN, EX: 30/02/1980)</span>
                                <input type="date" name="tgl_lahir" class="form-control" value="{{ $dataDiri->tgl_lahir ?? '' }}" {{ isset($dataDiri->tgl_lahir) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">No. HP</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(NO HARUS BISA DIHUBUNGI VIA TELP/WHATSAPP)</span>
                                <input type="text" name="telp" class="form-control" value="{{ $dataDiri->telp ?? '' }}" {{ isset($dataDiri->telp) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(EMAIL AKTIF)</span>
                                <input type="email" name="email" class="form-control" value="{{ $dataDiri->email ?? '' }}" {{ isset($dataDiri->email) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Jenjang</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(PILIH SESUAI DENGAN JENJANG ANDA)</span>
                                <select name="jenjang" class="form-control" {{ isset($dataDiri->jenjang) ? 'readonly' : 'required' }}>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="TK" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'TK/PAUD') ? 'selected' : '' }}>TK/PAUD</option>
                                    <option value="SD" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'SD') ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'SMP') ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'SMA') ? 'selected' : '' }}>SMA</option>
                                    <option value="SMAN" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'SMAN') ? 'selected' : '' }}>SMAN</option>
                                    <option value="SMK" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'SMK') ? 'selected' : '' }}>SMK</option>
                                    <option value="SMKN" {{ (isset($dataDiri->jenjang_str) && $dataDiri->jenjang_str == 'SMKN') ? 'selected' : '' }}>SMKN</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Kabupaten</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(PILIH SESUAI DENGAN KABUPATEN ANDA BEKERJA)</span>
                                <select name="kab" id="kab" class="form-control" required>
                                    <option value="">Pilih Kabupaten</option>
                                    <option value="1">Kota Yogyakarta</option>
                                    <option value="2">Kabupaten Bantul</option>
                                    <option value="3">Kabupaten Kulonprogo</option>
                                    <option value="4">Kabupaten Gunungkidul</option>
                                    <option value="5">Kabupaten Sleman</option>
                                    <option value="0">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Status Kepegawaian</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(PILIH STATUS KEPEGAWAIAN ANDA)</span>
                                <div class="mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="identitas" id="pns" value="1"
                                            {{ (isset($dataDiri->identitas) && $dataDiri->identitas == 1) ? 'checked' : '' }}
                                            {{ isset($dataDiri->identitas) ? 'readonly' : 'required' }}>
                                        <label class="form-check-label" for="pns">PNS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="identitas" id="non-pns" value="2"
                                            {{ (isset($dataDiri->identitas) && $dataDiri->identitas == 2) ? 'checked' : '' }}
                                            {{ isset($dataDiri->identitas) ? 'readonly' : 'required' }}>
                                        <label class="form-check-label" for="non-pns">NON PNS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="identitas" id="naban" value="3"
                                            {{ (isset($dataDiri->identitas) && $dataDiri->identitas == 3) ? 'checked' : '' }}
                                            {{ isset($dataDiri->identitas) ? 'readonly' : 'required' }}>
                                        <label class="form-check-label" for="naban">Tenaga Bantu (NABAN) DIY</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">NIP</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" name="nip" class="form-control" value="{{ $dataDiri->nip ?? '' }}" {{ isset($dataDiri->nip) ? 'readonly' : '' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">NUPTK</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" name="nuptk" class="form-control" value="{{ $dataDiri->nuptk ?? '' }}" {{ isset($dataDiri->nuptk) ? 'readonly' : '' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Pangkat</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" name="pangkat" class="form-control" value="{{ $dataDiri->pangkat ?? '' }}" {{ isset($dataDiri->pangkat) ? 'readonly' : '' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Golongan</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" name="golongan" class="form-control" value="{{ $dataDiri->golongan ?? '' }}" {{ isset($dataDiri->golongan) ? 'readonly' : '' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Instansi/Sekolah</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(EX: SMPN 2 WONOSARI *PENULISAN NEGERI DIGABUNG)</span>
                                <input type="text" name="sekolah" class="form-control" value="{{ $dataDiri->sekolah ?? '' }}" {{ isset($dataDiri->sekolah) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Jabatan</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(EX: GURU KELAS/GURU MAPEL BAHASA INDONESIA)</span>
                                <input type="text" name="jabatan" class="form-control" value="{{ $dataDiri->jabatan ?? '' }}" {{ isset($dataDiri->jabatan) ? 'readonly' : 'required' }}>
                            </div>

                            <div class="col-md-12">
                                <div class="alert alert-info mb-4">
                                    <strong>Diklat yang akan diikuti:</strong>
                                    <p class="mb-0">{{ $diklat->nama_diklat }}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn-submit">DAFTAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    let formValid = true;
                    const inputs = document.querySelectorAll('input[required], select[required]');

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            formValid = false;
                            input.classList.add('is-invalid');
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });

                    // Check radio buttons
                    if (document.querySelectorAll('input[name="identitas"]:checked').length === 0) {
                        formValid = false;
                        document.querySelectorAll('input[name="identitas"]').forEach(radio => {
                            radio.classList.add('is-invalid');
                        });
                    }

                    if (!formValid) {
                        e.preventDefault();
                        alert('Harap isi semua kolom yang wajib diisi!');
                    }
                });

                // Optional: Add real-time validation
                const inputs = document.querySelectorAll('input[required], select[required]');
                inputs.forEach(input => {
                    input.addEventListener('change', function() {
                        if (this.value.trim()) {
                            this.classList.remove('is-invalid');
                        } else {
                            this.classList.add('is-invalid');
                        }
                    });
                });
            });

            document.querySelector('form').addEventListener('submit', function(e) {
                let kabValue = document.querySelector('select[name="kab"]').value;
                console.log('Selected kabupaten value:', kabValue);

                if (!kabValue) {
                    e.preventDefault();
                    alert('Silakan pilih kabupaten');
                    return false;
                }
            });
        </script>
    </body>

@include('layouts.sections.footer.footer-user')
@endsection
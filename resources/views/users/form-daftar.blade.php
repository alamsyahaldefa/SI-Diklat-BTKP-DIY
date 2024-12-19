{{-- main.blade.php --}}
@extends('layouts.commonMaster')

@section('layoutContent')
    <!-- Laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
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
        }

        h1, h3 {
            font-weight: 700;
        }

        .form-container {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        .form-container input, .form-container select {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn-submit {
            background-color:#007bff;
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

        .info-section {
            background: linear-gradient(135deg, #e6f1ff, #ffffff);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .info-section h1 {
            color: #007bff;
        }

        .info-section .highlight {
            font-size: 1.3rem;
            font-weight: bold;
            color: #dc3545;
            text-transform: uppercase;
        }

        .info-section p {
            line-height: 1.8;
            font-size: 1rem;
        }

        .form-section h4 {
            font-weight: bold;
            color: #555;
        }

        .submit-btn {
            background-color: #20c997;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background-color: #1ea385;
        }

        .alert {
            border-radius: 8px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }


    .container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }

    h3 {
        font-size: 1.5rem;
        color: #333;
    }

    p {
        font-size: 1rem;
        color: #6c757d;
    }

    img {
        width: 60px;
        height: 60px;
    }

    </style>

    @include('layouts.sections.navbar.navbar-user')

    <body>
        <div class="container py-5">
            <h1 class="text-center mb-4">PENDAFTARAN DIKLAT</h1>

<!-- jika sudah terdaftar ini akan muncul-->
            <div class="container mt-5 mb-4">
            <div class="row align-items-center">
        <div class="col-auto">
            <div class="rounded-circle border d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; background-color: #f1f1f1;">
                <i class='bx bx-user' style="font-size: 2rem; color: #6c757d;"></i>
            </div>
        </div>
        <div class="col mt-1">
            <h3 class="mb-0 fw-bold">CHATARINA SRI SUDARMI, S. PD</h3>
            <p class="text-muted mb-0">NIK: 0</p>
        </div>
    </div>
</div>
<!--  -->



            <!-- Perhatian Section -->
            <div class="alert alert-secondary mb-2" role="alert">
                <strong>Perhatian:</strong>
                <ul class="mb-0">
                    <li>Isi data anda dengan lengkap, termasuk NIK, nama, email, dan data lainnya.</li>
                    <li>Jika data anda tidak lengkap, maka pendaftaran otomatis dibatalkan.</li>
                    <li>Harap gunakan nomor HP yang aktif untuk konfirmasi kehadiran.</li>
                </ul>
            </div>
            <!-- Form Section -->
            <div class="row">
                <div class="col-md-12 form-container">
                    <h4 class="mb-4 text-center">Formulir Data Diri</h4>
                    <form action="{{ route('form.daftar') }}" method="GET">
                        <div class="row g-3">
                        <div class="col-md-12">
    <label for="nik" class="form-label">NIK</label>
    <span class="text-danger ms-2" style="font-size: 0.9em;">(PENULISAN TANPA SPASI)</span>
    <input type="text" class="form-control mt-1" id="nik" placeholder="Masukkan NIK Anda" required>
</div>
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(DISARANKAN MENGGUNAKAN GELAR)</span>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Anda" required>
                            </div>
                            <div class="col-md-12">
                                <label for="nohp" class="form-label">No HP</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(NO HARUS BISA DIHUBUNGI VIA TELP/WHATSAPP)</span>
                                <input type="text" class="form-control" id="nohp" placeholder="Masukkan Nomor HP Aktif" required>
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(EMAIL AKTIF)</span>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan Email Anda" required>
                            </div>
                            <div class="col-md-12">
                                <label for="jabatan" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tmp_lahir" placeholder="Masukkan Tempat Lahir Anda" required>
                            </div>
                            <div class="col-md-12">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(HARI/BULAN/TAHUN, EX: 30/02/1980)</span>
                                <input type="date" class="form-control" id="tgl_lahir" required>
                            </div>
                            <div class="col-md-12">
                                <label for="instansi" class="form-label">Nama Instansi / Lembaga</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(EX: SMPN 2 WONOSARI *PENULISAN NEGERI DIGABUNG)</span>
                                <input type="text" class="form-control" id="instansi" placeholder="Nama Instansi Anda" required>
                            </div>
                            <div class="col-md-12">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" placeholder="Masukkan Jabatan Anda" required>
                            </div>
                            <div class="col-md-12">
                                <label for="jenjang" class="form-label">Jenjang</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(PILIH SESUAI DENGAN JENJANG ANDA)</span>
                                <select id="jenjang" class="form-select" required>
                                    <option selected disabled>Pilih Jenjang</option>
                                    <option value="sd">SD</option>
                                    <option value="smp">SMP</option>
                                    <option value="sma">SMA</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(PILIH SESUAI DENGAN KABUPATEN ANDA BEKERJA)</span>
                                <select id="kabupaten" class="form-select" required>
                                    <option selected disabled>Pilih Kabupaten</option>
                                    <option value="kab1">Kabupaten 1</option>
                                    <option value="kab2">Kabupaten 2</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="nip" class="form-label">NIP</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" id="nip" class="form-control" placeholder="Masukkan NIP Anda">
                            </div>
                            <div class="col-md-12">
                                <label>Status</label>
                                <div>
                                    <input type="radio" name="status" id="pns" value="PNS" required> <label for="pns">PNS</label>
                                    <input type="radio" name="status" id="non-pns" value="NON-PNS" required> <label for="non-pns">NON PNS</label>
                                    <input type="radio" name="status" id="naban" value="NABAN" required> <label for="naban">Tenaga Bantu (NABAN) DIY</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="nuptk" class="form-label">NUPTK</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" id="nuptk" class="form-control" placeholder="Masukkan NUPTK Anda">
                            </div>
                            <div class="col-md-12">
                                <label for="pangkat" class ="form-label">Pangkat</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" id="pangkat" class="form-control" placeholder="Masukkan Pangkat Anda">
                            </div>
                            <div class="col-md-12">
                                <label for="golongan" class="form-label">Golongan</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(JIKA TIDAK ADA DIKOSONGKAN SAJA)</span>
                                <input type="text" id="golongan" class="form-control" placeholder="Masukkan Golongan Anda">
                            </div>
                            <div class="col-md-12">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <span class="text-danger ms-2" style="font-size: 0.9em;">(EX: GURU KELAS/GURU MAPEL BAHASA INDONESIA)</span>
                                <input type="text" id="jabatan" class="form-control" placeholder="Masukkan Jabatan Anda" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn-submit">DAFTAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script>
    document.querySelector("form").addEventListener("submit", function (e) {
        let formValid = true;
        const inputs = document.querySelectorAll("input[required], select[required]");
        inputs.forEach(input => {
            if (!input.value.trim()) {
                formValid = false;
                input.classList.add("is-invalid");
            } else {
                input.classList.remove("is-invalid");
            }
        });

        if (!formValid) {
            e.preventDefault();
            alert("Harap isi semua kolom yang wajib diisi!");
        }
    });
</script>

    @include('layouts.sections.footer.footer-user')
@endsection
@extends('layouts/contentNavbarLayout')

@section('title', 'Rekap Data Diklat -')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-2">
    <h3>Rekap Data Diklat</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Administrator</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('data-diklat') }}">Data Diklat</a>
            </li>
            <li class="breadcrumb-item active">Rekap Data Diklat</li>
        </ol>
    </nav>
</div>

<div class="col-xxl mb-3">
    <div class="card mb-0">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="bx bx-info-circle"></i> Detail Info Diklat</h5>
        </div>
        <hr class="mt-0 mb-0">
        </hr>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Nama Diklat:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>{{ $diklat->nama_diklat ?? 'Data tidak tersedia' }}</small>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Tanggal Diklat:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>
                            {{ $diklat->tgl_mulai ? $diklat->tgl_mulai->format('d M Y') : 'Tidak ada' }}
                            s/d
                            {{ $diklat->tgl_selesai ? $diklat->tgl_selesai->format('d M Y') : 'Tidak ada' }}
                        </small>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Kuota:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0"><small>{{ $diklat->kuota ?? 'Tidak ada' }} Peserta</small></p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Jumlah Pendaftar:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>{{ $diklat->pesertaMendaftar->count() }} Pendaftar</small>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Status Diklat:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>
                            {{ $diklat->status ? 'Pendaftaran Masih Dibuka' : 'Pendaftaran Sudah Ditutup' }}
                        </small>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Status Pengumuman:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>
                            {{ $diklat->pengumuman ? 'Pengumuman Sudah Diterbitkan' : 'Pengumuman Belum Diterbitkan' }}
                        </small>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>File Surat Undangan:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>{{ $diklat->surat ? 'Ada' : 'Belum ada' }}</small>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Syarat dan Ketentuan:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>{{ $diklat->syarat ?? 'Tidak ada syarat dan ketentuan yang tersedia.' }}</small>
                    </p>
                </div>
            </div>


            <div class="col-xxl mb-3">
                <div class="card mb-0">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0"><i class="bx bx-info-circle"></i> Data Peserta Diklat</h5>
                    </div>
                    <hr class="mt-0 mb-0">
                    </hr>
                    <div class="card-body">
                        <!-- Button Filter Peserta -->
                        <div class="row mb-3">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnToggle" id="btnLolos" autocomplete="off" checked
                                    onclick="toggleTable('lolos')">
                                <label class="btn btn-outline-dark" for="btnLolos">Peserta Lolos</label>

                                <input type="radio" class="btn-check" name="btnToggle" id="btnMendaftar" autocomplete="off"
                                    onclick="toggleTable('mendaftar')">
                                <label class="btn btn-outline-dark" for="btnMendaftar">Peserta Mendaftar</label>
                            </div>
                        </div>

                        <!-- Tabel Peserta Lolos -->
                        <div id="lolosTable" class="card">
                            <div class="table-responsive">
                                <table class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th><strong>No</strong></th>
                                            <th><strong>Nama Peserta</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Telp</strong></th>
                                            <th><strong>Aksi</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- Row 1 -->
                                        <tr>
                                            <td><small>1</small></td>
                                            <td>
                                                <span style="font-weight: bold; color: var(--bs-secondary);">Bapa Budi
                                                    Satu</span><br>
                                                <span>
                                                    <small>Jabatan Mengajar: </small><small class="jabatan">Guru Muda</small>
                                                </span><br>
                                                <span>
                                                    <small>dari: </small><small class="asal-sekolah">SMKN 1 Jogja
                                                        (Yogyakarta)</small>
                                                </span>
                                            </td>
                                            <td><small>PNS</small></td>
                                            <td><small>budisatu@gmail.com</small></td>
                                            <td><small>08123456789</small></td>

                                            <td class="actions">
                                                <div class="d-flex gap-0 justify-content-start">


                                                    <!-- Tombol Hapus Diklat -->
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Batalkan Peserta" id="hapusPesertaBtn1">
                                                        <i class="bx bx-x-circle"></i>
                                                    </a>

                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                    <script>
                                                        document.getElementById('hapusPesertaBtn1').addEventListener('click', function() {
                                                            Swal.fire({
                                                                title: "Apakah yakin anda akan membatalkan peserta ini untuk lolos diklat?",
                                                                text: "Peserta ini akan dikembalikan ke data pendaftar",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#d33",
                                                                cancelButtonColor: "#6c757d",
                                                                confirmButtonText: "Ya, Batalkan!",
                                                                cancelButtonText: "Kembali",
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: "Deleted!",
                                                                        text: "Peserta telah dibatalkan.",
                                                                        icon: "success"
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <!-- Button sertif -->
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Mengambil Sertifikat" id="SertifBtn">
                                                        <i class="bx bx-book"></i>
                                                    </a>
                                                    <script>
                                                        document.getElementById('SertifBtn').addEventListener('click', function() {
                                                            Swal.fire({
                                                                title: "Apakah yakin anda bahwa peserta ini sudah mengambil sertifikat?",
                                                                text: "Data Pengambilan akan diset menjadi sudah diterima",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#d33",
                                                                cancelButtonColor: "#6c757d",
                                                                confirmButtonText: "Ya, Sudah!",
                                                                cancelButtonText: "Kembali",
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: "Deleted!",
                                                                        text: "Peserta telah dibatalkan.",
                                                                        icon: "success"
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 2 -->
                                        <tr>
                                            <td><small>2</small></td>
                                            <td>
                                                <span style="font-weight: bold; color: var(--bs-secondary);">Bapa Budi
                                                    Dua</span><br>
                                                <span>
                                                    <small>Jabatan Mengajar: </small><small class="jabatan">Guru Muda</small>
                                                </span><br>
                                                <span>
                                                    <small>dari: </small><small class="asal-sekolah">SMKN 1 Nglipar
                                                        (Gunungkidul)</small>
                                                </span>
                                            </td>

                                            <td><small>PNS</small></td>
                                            <td><small>budidua@gmail.com</small></td>
                                            <td><small>08123456789</small></td>

                                            <td class="actions">
                                                <div class="d-flex gap-0 justify-content-start">


                                                    <!-- Tombol Hapus Diklat -->
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Batalkan Peserta" id="hapusPesertaBtn2">
                                                        <i class="bx bx-x-circle"></i>
                                                    </a>

                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                    <script>
                                                        document.getElementById('hapusPesertaBtn2').addEventListener('click', function() {
                                                            Swal.fire({
                                                                title: "Apakah yakin anda akan membatalkan peserta ini untuk lolos diklat?",
                                                                text: "Peserta ini akan dikembalikan ke data pendaftar",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#d33",
                                                                cancelButtonColor: "#6c757d",
                                                                confirmButtonText: "Ya, Batalkan!",
                                                                cancelButtonText: "Kembali",
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: "Deleted!",
                                                                        text: "Peserta telah dibatalkan.",
                                                                        icon: "success"
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <!-- Button sertif -->
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Mengambil Sertifikat" id="SertifBtn2">
                                                        <i class="bx bx-book"></i>
                                                    </a>
                                                    <script>
                                                        document.getElementById('SertifBtn2').addEventListener('click', function() {
                                                            Swal.fire({
                                                                title: "Apakah yakin anda bahwa peserta ini sudah mengambil sertifikat?",
                                                                text: "Data Pengambilan akan diset menjadi sudah diterima",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#d33",
                                                                cancelButtonColor: "#6c757d",
                                                                confirmButtonText: "Ya, Sudah!",
                                                                cancelButtonText: "Kembali",
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: "Deleted!",
                                                                        text: "Peserta telah dibatalkan.",
                                                                        icon: "success"
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <style>
                            /* Atur lebar kolom */
                            #mendaftarTable table.table th,
                            #mendaftarTable table.table td {
                                vertical-align: middle;
                                /* Selaraskan isi di tengah secara vertikal */
                            }

                            #mendaftarTable table.table th {
                                text-align: start;
                                /* Teks header rata tengah */
                            }

                            #mendaftarTable table.table .w-30 {
                                width: 30%;
                                /* Kolom nama peserta */
                            }

                            #mendaftarTable table.table .w-10 {
                                width: 10%;
                                /* Kolom status, tanggal daftar, aksi, tandai */
                            }

                            #mendaftarTable table.table .small-col {
                                text-align: center;
                                /* Elemen kecil rata tengah */
                            }

                            #mendaftarTable .table-responsive {
                                overflow-x: auto;
                                /* Agar tabel tetap responsif */
                            }

                            /* Font-size 10px untuk kolom Nama Peserta dan Diklat yang Pernah Diikuti */
                            #mendaftarTable td:nth-child(2) {
                                font-size: 13px;
                            }

                            #mendaftarTable td:nth-child(5) {
                                font-size: 12px;
                                /* Ukuran font kecil */
                                color: black;
                            }

                            /* Font-size 13px untuk kolom selain Nama Peserta dan Diklat yang Pernah Diikuti */
                            #mendaftarTable td:not(:nth-child(2)):not(:nth-child(5)) {
                                font-size: 13px;
                                /* Ukuran font standar */
                            }

                            /* Checkbox rata tengah */
                            #mendaftarTable .form-check {
                                display: flex;
                                justify-content: center;
                            }

                            /* Tambahkan outline pada checkbox */
                            #mendaftarTable .form-check-input {
                                width: 18px;
                                /* Ukuran lebih besar agar lebih terlihat */
                                height: 18px;
                                outline: 2px solid #ccc;
                                /* Outline tambahan */
                            }

                            /* Hover efek pada checkbox */
                            #mendaftarTable .form-check-input:hover {
                                border-color: #0a58ca;
                                /* Warna lebih gelap saat hover */
                                outline-color: grey;
                                /* Outline saat hover */
                            }

                            /* Wrapper untuk dropdown dengan ikon */
                            .dropdown-with-icon {
                                position: relative;
                            }

                            /* Posisi ikon toga */
                            .dropdown-with-icon .dropdown-icon {
                                position: absolute;
                                top: 50%;
                                transform: translateY(-50%);
                                font-size: 1.5rem;
                                pointer-events: none;
                                /* Supaya tidak mengganggu klik pada dropdown */
                            }

                            /* Tambahkan padding kiri pada dropdown agar tidak bertumpuk dengan ikon */
                            .dropdown-with-icon select {
                                padding-left: 2.5rem;
                            }
                        </style>


                        <!-- Tabel Peserta Mendaftar -->
                        <div id="mendaftarTable" class="card">
                            <div class="table-responsive">
                                <table class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th><strong>No</strong></th>
                                            <th class="w-30"><strong>Nama Peserta</strong></th>
                                            <th class="w-10"><strong>Status</strong></th>
                                            <th class="w-10"><strong>Tanggal Daftar</strong></th>
                                            <th class="w-30"><strong>Diklat yang Pernah Diikuti</strong></th>
                                            <th class="w-10"><strong>Aksi</strong></th>
                                            <th class="w-10"><strong>Tandai</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- Row 1 -->
                                        <tr>
                                            <td><small>1</small></td>
                                            <td>
                                                <span style="font-weight: bold; color: var(--bs-secondary);">Bapa Budi
                                                    Satu</span><br>
                                                <span>
                                                    <small>Jabatan Mengajar: </small><small class="jabatan">Guru Muda</small>
                                                </span><br>
                                                <span>
                                                    <small>dari: </small><small class="asal-sekolah">SMKN 1 Jogja
                                                        (Yogyakarta)</small>
                                                </span>
                                            </td>
                                            <td><small>PNS</small></td>
                                            <td><small>08 Nov 2024</small></td>
                                            <td><small>
                                                    - (2021) Pendataan Ulang Peserta Bimbingan Teknis Produksi Media Pembelajaran
                                                    Berbasis Video
                                                    Angkatan 2
                                                    - BIMTEK ONLINE PEMANFAATAN TIK. Angkatan 1 Tahun 2023</small></td>

                                            <td class="actions">
                                                <div class="d-flex gap-0 justify-content-start">

                                                    <!-- Tombol Hapus Diklat -->
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Batalkan Peserta" id="btnPeserta1">
                                                        <i class="bx bx-x-circle"></i>
                                                    </a>

                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                    <script>
                                                        const hapusPesertaBtn = document.getElementById('btnPeserta1');
                                                        const hapusPesertaIcon = hapusPesertaBtn.querySelector('i');

                                                        hapusPesertaBtn.addEventListener('click', function() {
                                                            if (hapusPesertaIcon.classList.contains('bx-x-circle')) {
                                                                // SweetAlert untuk konfirmasi pembatalan
                                                                Swal.fire({
                                                                    title: "Apakah yakin anda akan membatalkan peserta ini untuk lolos diklat?",
                                                                    text: "Peserta ini akan dikembalikan ke data pendaftar",
                                                                    icon: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#d33",
                                                                    cancelButtonColor: "#6c757d",
                                                                    confirmButtonText: "Ya, Batalkan!",
                                                                    cancelButtonText: "Kembali",
                                                                    reverseButtons: true
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Ubah ikon ke centang circle
                                                                        hapusPesertaIcon.classList.replace('bx-x-circle', 'bx-check-circle');
                                                                        hapusPesertaBtn.setAttribute('title', 'Terima Peserta');
                                                                        Swal.fire({
                                                                            title: "Berhasil!",
                                                                            text: "Peserta telah dibatalkan.",
                                                                            icon: "success"
                                                                        });
                                                                    }
                                                                });
                                                            } else if (hapusPesertaIcon.classList.contains('bx-check-circle')) {
                                                                // SweetAlert untuk konfirmasi penerimaan peserta
                                                                Swal.fire({
                                                                    title: "Apakah yakin anda akan menerima peserta ini untuk lolos diklat?",
                                                                    text: "Peserta ini akan masuk ke data lolos seleksi",
                                                                    icon: "question",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#28a745",
                                                                    cancelButtonColor: "#6c757d",
                                                                    confirmButtonText: "Ya, Terima!",
                                                                    cancelButtonText: "Kembali",
                                                                    reverseButtons: true
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Ubah ikon kembali ke x-circle
                                                                        hapusPesertaIcon.classList.replace('bx-check-circle', 'bx-x-circle');
                                                                        hapusPesertaBtn.setAttribute('title', 'Batalkan Peserta');
                                                                        Swal.fire({
                                                                            title: "Berhasil!",
                                                                            text: "Peserta telah diterima.",
                                                                            icon: "success"
                                                                        });
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    </script>


                                                    <!-- Button edit -->
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditDiklatPeserta" title="Edit Diklat Peserta">
                                                        <i class="bx bx-edit"></i>
                                                    </a>

                                                    <div class="modal fade" id="modalEditDiklatPeserta" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalEditDiklatPesertaTitle">Edit
                                                                        Diklat Peserta</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-12">
                                                                            <label for="namaPeserta" class="form-label">Nama
                                                                                Peserta</label>
                                                                            <input type="text" class="form-control" id="namaPeserta"
                                                                                value="Bapa Budi Satu" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-12">
                                                                            <label for="asalSekolahPeserta" class="form-label">Asal
                                                                                Sekolah</label>
                                                                            <input type="text" class="form-control"
                                                                                id="asalSekolahPeserta"
                                                                                value="SMKN 1 Jogja (Yogyakarta)" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <label for="pilihDiklatPeserta" class="form-label">Pilih
                                                                                Diklat</label>
                                                                            <div class="dropdown-with-icon">
                                                                                <i class="bx bxs-graduation dropdown-icon"></i>
                                                                                <select class="form-select ps-5"
                                                                                    id="pilihDiklatPeserta">
                                                                                    <option selected value="diklat-sebelumnya">
                                                                                        Pendataan Ulang Peserta BIMTEK Produksi
                                                                                        Media Pembelajaran Video</option>
                                                                                    <option value="diklat-1">BIMTEK Online
                                                                                        Pemanfaatan TIK Tahun 2023</option>
                                                                                    <option value="diklat-2">Pelatihan Pengelolaan
                                                                                        Sistem Informasi Sekolah</option>
                                                                                    <option value="diklat-3">Workshop Desain Media
                                                                                        Pembelajaran Interaktif</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn rounded-pill btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="button"
                                                                        class="btn rounded-pill btn-outline-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="mendaftarTable">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="defaultCheck1" />
                                                        <label class="form-check-label" for="defaultCheck1"></label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 2 -->
                                        <tr>
                                            <td><small>2</small></td>
                                            <td>
                                                <span style="font-weight: bold; color: var(--bs-secondary);">Bapa Budi
                                                    Dua</span><br>
                                                <span>
                                                    <small>Jabatan Mengajar: </small><small class="jabatan">Guru Muda</small>
                                                </span><br>
                                                <span>
                                                    <small>dari: </small><small class="asal-sekolah">SMKN 1 Nglipar
                                                        (Gunungkidul)</small>
                                                </span>
                                            </td>
                                            <td><small>PNS</small></td>
                                            <td><small>17 Aug 2024</small></td>
                                            <td><small>
                                                    - (2021) Pendataan Ulang Peserta Bimbingan Teknis Produksi Media Pembelajaran
                                                    Berbasis Video Angkatan 2
                                                    - BIMTEK ONLINE PEMANFAATAN TIK. Angkatan 1 Tahun 2023</small></td>
                                            <td class="actions">
                                                <div class="d-flex gap-0 justify-content-start">
                                                    <!-- Tombol Hapus Diklat -->
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Batalkan Peserta" id="btnPeserta2">
                                                        <i class="bx bx-x-circle"></i>
                                                    </a>

                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                    <script>
                                                        const hapusPesertaBtn = document.getElementById('btnPeserta2');
                                                        const hapusPesertaIcon = hapusPesertaBtn.querySelector('i');

                                                        hapusPesertaBtn.addEventListener('click', function() {
                                                            if (hapusPesertaIcon.classList.contains('bx-x-circle')) {
                                                                // SweetAlert untuk konfirmasi pembatalan
                                                                Swal.fire({
                                                                    title: "Apakah yakin anda akan membatalkan peserta ini untuk lolos diklat?",
                                                                    text: "Peserta ini akan dikembalikan ke data pendaftar",
                                                                    icon: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#d33",
                                                                    cancelButtonColor: "#6c757d",
                                                                    confirmButtonText: "Ya, Batalkan!",
                                                                    cancelButtonText: "Kembali",
                                                                    reverseButtons: true
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Ubah ikon ke centang circle
                                                                        hapusPesertaIcon.classList.replace('bx-x-circle', 'bx-check-circle');
                                                                        hapusPesertaBtn.setAttribute('title', 'Terima Peserta');
                                                                        Swal.fire({
                                                                            title: "Berhasil!",
                                                                            text: "Peserta telah dibatalkan.",
                                                                            icon: "success"
                                                                        });
                                                                    }
                                                                });
                                                            } else if (hapusPesertaIcon.classList.contains('bx-check-circle')) {
                                                                // SweetAlert untuk konfirmasi penerimaan peserta
                                                                Swal.fire({
                                                                    title: "Apakah yakin anda akan menerima peserta ini untuk lolos diklat?",
                                                                    text: "Peserta ini akan masuk ke data lolos seleksi",
                                                                    icon: "question",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#28a745",
                                                                    cancelButtonColor: "#6c757d",
                                                                    confirmButtonText: "Ya, Terima!",
                                                                    cancelButtonText: "Kembali",
                                                                    reverseButtons: true
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Ubah ikon kembali ke x-circle
                                                                        hapusPesertaIcon.classList.replace('bx-check-circle', 'bx-x-circle');
                                                                        hapusPesertaBtn.setAttribute('title', 'Batalkan Peserta');
                                                                        Swal.fire({
                                                                            title: "Berhasil!",
                                                                            text: "Peserta telah diterima.",
                                                                            icon: "success"
                                                                        });
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    </script>

                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditDiklatPeserta" title="Edit Diklat Peserta">
                                                        <i class="bx bx-edit"></i>
                                                    </a>

                                                    <div class="modal fade" id="modalEditDiklatPeserta" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalEditDiklatPesertaTitle">Edit
                                                                        Diklat Peserta</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-12">
                                                                            <label for="namaPeserta" class="form-label">Nama
                                                                                Peserta</label>
                                                                            <input type="text" class="form-control" id="namaPeserta"
                                                                                value="Bapa Budi Satu" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-12">
                                                                            <label for="asalSekolahPeserta" class="form-label">Asal
                                                                                Sekolah</label>
                                                                            <input type="text" class="form-control"
                                                                                id="asalSekolahPeserta"
                                                                                value="SMKN 1 Jogja (Yogyakarta)" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <label for="pilihDiklatPeserta" class="form-label">Pilih
                                                                                Diklat</label>
                                                                            <div class="dropdown-with-icon">
                                                                                <i class="bx bxs-graduation dropdown-icon"></i>
                                                                                <select class="form-select ps-5"
                                                                                    id="pilihDiklatPeserta">
                                                                                    <option selected value="diklat-sebelumnya">
                                                                                        Pendataan Ulang Peserta BIMTEK Produksi
                                                                                        Media Pembelajaran Video</option>
                                                                                    <option value="diklat-1">BIMTEK Online
                                                                                        Pemanfaatan TIK Tahun 2023</option>
                                                                                    <option value="diklat-2">Pelatihan Pengelolaan
                                                                                        Sistem Informasi Sekolah</option>
                                                                                    <option value="diklat-3">Workshop Desain Media
                                                                                        Pembelajaran Interaktif</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn rounded-pill btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="button"
                                                                        class="btn rounded-pill btn-outline-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                                                    <label class="form-check-label" for="defaultCheck2"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                // Fungsi untuk mengubah tampilan tabel berdasarkan tombol yang dipilih
                function toggleTable(table) {
                    // Menyembunyikan kedua tabel
                    document.getElementById('lolosTable').style.display = 'none';
                    document.getElementById('mendaftarTable').style.display = 'none';

                    // Menampilkan tabel yang dipilih
                    if (table === 'lolos') {
                        document.getElementById('lolosTable').style.display = 'block';
                    } else if (table === 'mendaftar') {
                        document.getElementById('mendaftarTable').style.display = 'block';
                    }
                }

                // Memanggil fungsi untuk menampilkan tabel peserta lolos saat halaman dimuat
                window.onload = function() {
                    toggleTable('lolos');
                }
            </script>


            @endsection
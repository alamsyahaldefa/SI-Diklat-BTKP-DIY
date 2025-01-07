@extends('layouts/contentNavbarLayout')

@section('title', 'Rekap Data Diklat -')
<meta name="csrf-token" content="{{ csrf_token() }}">

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

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="bx bx-info-circle"></i> Detail Info Diklat</h5>
        </div>
        <hr class="mt-0 mb-0"></hr>
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
                    <p class="mb-0"><small>{{ $diklat->kuota }}</small></p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <p class="mb-0"><strong>Jumlah Pendaftar:</strong></p>
                </div>
                <div class="col-md-9">
                    <p class="mb-0">
                        <small>{{ $diklat->peserta()->where('status', 0)->count() }} Pendaftar</small>
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
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="bx bx-info-circle"></i> Data Peserta Diklat</h5>
        </div>
        <hr class="mt-0 mb-0"></hr>
        <div class="card-body">
            <!-- Button Filter Peserta -->
            <div class="row mb-3">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnToggle" id="btnLolos" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="btnLolos">Peserta Lolos</label>

                    <input type="radio" class="btn-check" name="btnToggle" id="btnMendaftar" autocomplete="off">
                    <label class="btn btn-outline-dark" for="btnMendaftar">Peserta Mendaftar</label>
                </div>
            </div>

            <!-- Tabel Peserta Lolos -->
            <div id="lolosTable" class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
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
                            @foreach($diklat->peserta()->where('status', 1)->get() as $index => $peserta)
                            <tr>
                                <td><small>{{ $index + 1 }}</small></td>
                                <td>
                                    <span style="font-weight: bold; color: var(--bs-secondary);">
                                        {{ $peserta->user->nama ?? 'Nama tidak tersedia' }}
                                    </span><br>
                                    <span>
                                        <small>Jabatan Mengajar: </small>
                                        <small class="jabatan">{{ $peserta->user->jabatan ?? '-' }}</small>
                                    </span><br>
                                    <span>
                                        <small>dari: </small>
                                        <small class="asal-sekolah">{{ $peserta->user->sekolah ?? '-' }}</small>
                                    </span>
                                </td>
                                <td><small>{{ $peserta->user->status_kepegawaian ?? '-' }}</small></td>
                                <td><small>{{ $peserta->user->email ?? '-' }}</small></td>
                                <td><small>{{ $peserta->user->telp ?? '-' }}</small></td>
                                <!-- Di tabel peserta lolos -->
                                <td class="actions">
                                    <div class="d-flex gap-0 justify-content-start">
                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Batalkan Peserta" class="btn-batalkan" data-id="{{ $peserta->id_peserta }}">
                                            <i class="bx bx-x-circle"></i>
                                        </a>
                                        
                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Mengambil Sertifikat" class="btn-sertifikat" data-id="{{ $peserta->id_peserta }}">
                                            <i class="bx bx-book"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Peserta Mendaftar -->
            <div id="mendaftarTable" class="card" style="display: none;">
                <div class="table-responsive">
                    <table class="table table-hover">
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
                            @foreach($diklat->peserta()->where('status', 0)->get() as $index => $peserta)
                            <tr>
                                <td><small>{{ $index + 1 }}</small></td>
                                <td>
                                    <span style="font-weight: bold; color: var(--bs-secondary);">
                                        {{ $peserta->user->nama ?? 'Nama tidak tersedia' }}
                                    </span><br>
                                    <span>
                                        <small>Jabatan Mengajar: </small>
                                        <small class="jabatan">{{ $peserta->user->jabatan ?? '-' }}</small>
                                    </span><br>
                                    <span>
                                        <small>dari: </small>
                                        <small class="asal-sekolah">{{ $peserta->user->sekolah ?? '-' }}</small>
                                    </span>
                                </td>
                                <td><small>{{ $peserta->user->status_kepegawaian ?? '-' }}</small></td>
                                <td><small>{{ $peserta->tgl ? \Carbon\Carbon::parse($peserta->tgl)->format('d M Y') : '-' }}</small></td>
                                <td><small>{{ $peserta->riwayat_diklat ?? '-' }}</small></td>
                                <td class="actions">
                                    <div class="d-flex gap-0 justify-content-start">
                                        <!-- Tombol Toggle Status -->
                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Terima/Batalkan Peserta" id="btnPeserta{{ $peserta->id_peserta }}">
                                            <i class="bx bx-x-circle" id="iconPeserta{{ $peserta->id_peserta }}"></i>
                                        </a>

                                        <!-- Button edit -->
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#modalEditDiklatPeserta" 
                                            onclick="editPeserta({{ $peserta->id_peserta }})"
                                            title="Edit Diklat Peserta">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $peserta->id_peserta }}" />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- @push('style')
<style>
    /* Atur lebar kolom */
    #mendaftarTable table.table th,
    #mendaftarTable table.table td {
        vertical-align: middle;
    }

    #mendaftarTable table.table th {
        text-align: start;
    }

    #mendaftarTable table.table .w-30 {
        width: 30%;
    }

    #mendaftarTable table.table .w-10 {
        width: 10%;
    }

    #mendaftarTable table.table .small-col {
        text-align: center;
    }

    #mendaftarTable .table-responsive {
        overflow-x: auto;
    }

    #mendaftarTable td:nth-child(2) {
        font-size: 13px;
    }

    #mendaftarTable td:nth-child(5) {
        font-size: 12px;
        color: black;
    }

    #mendaftarTable td:not(:nth-child(2)):not(:nth-child(5)) {
        font-size: 13px;
    }

    #mendaftarTable .form-check {
        display: flex;
        justify-content: center;
    }

    #mendaftarTable .form-check-input {
        width: 18px;
        height: 18px;
        outline: 2px solid #ccc;
    }

    #mendaftarTable .form-check-input:hover {
        border-color: #0a58ca;
        outline-color: grey;
    }

    .dropdown-with-icon {
        position: relative;
    }

    .dropdown-with-icon .dropdown-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
        pointer-events: none;
    }

    .dropdown-with-icon select {
        padding-left: 2.5rem;
    }
</style>
@endpush -->

@push('script')
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle function for tables
    function toggleTable(table) {
        document.getElementById('lolosTable').style.display = 'none';
        document.getElementById('mendaftarTable').style.display = 'none';
        document.getElementById(table + 'Table').style.display = 'block';
    }

    // Add event listeners to radio buttons
    document.getElementById('btnLolos').addEventListener('change', function() {
        toggleTable('lolos');
    });

    document.getElementById('btnMendaftar').addEventListener('change', function() {
        toggleTable('mendaftar');
    });

    // Initial display
    toggleTable('lolos');

    // Handle button actions
    const batalkanButtons = document.querySelectorAll('.btn-batalkan');
    batalkanButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const idPeserta = this.dataset.id;
            console.log('Button batalkan clicked, id:', idPeserta);

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
                    // Show loading state
                    Swal.showLoading();

                    fetch(`/diklat/peserta/${idPeserta}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ status: 0 })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: data.message,
                                icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: "Error!",
                            text: error.message || "Terjadi kesalahan saat memproses permintaan",
                            icon: "error"
                        });
                    });
                }
            });
        });
    });

    // Add error reporting
    window.onerror = function(msg, url, lineNo, columnNo, error) {
        console.log('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
        return false;
    };
});
</script>
@endpush
@endsection
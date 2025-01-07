@extends('layouts/contentNavbarLayout')

@section('title', 'Rekap Data Diklat')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <!-- Info Diklat Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bx bx-info-circle"></i> Detail Info Diklat</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Diklat:</strong> {{ $diklat->nama_diklat }}</p>
            <p><strong>Tanggal Diklat:</strong> 
                {{ \Carbon\Carbon::parse($diklat->tgl_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($diklat->tgl_selesai)->format('d M Y') }}
            </p>
            <p><strong>Kuota:</strong> {{ $diklat->kuota }}</p>
            <p><strong>Status Diklat:</strong> 
                {{ $diklat->status ? 'Pendaftaran Masih Dibuka' : 'Pendaftaran Sudah Ditutup' }}
            </p>
            <p><strong>Jumlah Pendaftar:</strong> {{ $pesertaMendaftar->count() }}</p>
        </div>
    </div>

    <!-- Data Peserta Diklat -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bx bx-info-circle"></i> Data Peserta Diklat</h5>
        </div>
        <div class="card-body">
            <!-- Dropdown Filter -->
            <div class="mb-3">
                <label for="filterPeserta" class="form-label"><strong>Filter Peserta:</strong></label>
                <select id="filterPeserta" class="form-select">
                    <option value="lolos">Peserta Lolos ({{ $pesertaLolos->count() }})</option>
                    <option value="mendaftar">Peserta Mendaftar ({{ $pesertaMendaftar->count() }})</option>
                </select>
            </div>

            <!-- Tabel Peserta Lolos -->
            <div id="lolosTable" class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertaLolos as $index => $peserta)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $peserta->user->nama }}</strong><br>
                                <small>Jabatan: {{ $peserta->user->jabatan }}</small><br>
                                <small>Sekolah: {{ $peserta->user->sekolah }}</small>
                            </td>
                            <td>{{ $peserta->user->email }}</td>
                            <td>{{ $peserta->user->telp }}</td>
                            <td class="actions">
                                <div class="d-flex gap-2">
                                    <!-- Tombol "Tolak" -->
                                    <button 
                                        class="btn btn-danger btn-sm btn-update-status" 
                                        data-id="{{ $peserta->id_peserta }}" 
                                        data-status="0">
                                        <i class="bx bx-x-circle"></i> Tolak
                                    </button>

                                    <!-- Tombol "Lihat Sertifikasi" -->
                                    <button 
                                        class="btn btn-primary btn-sm btn-sertifikasi" 
                                        data-id="{{ $peserta->id_peserta }}">
                                        <i class="bx bx-book"></i> Lihat Sertifikasi
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada peserta lolos</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Peserta Mendaftar -->
            <div id="mendaftarTable" class="table-responsive" style="display: none;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertaMendaftar as $index => $peserta)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $peserta->user->nama }}</strong><br>
                                <small>Jabatan: {{ $peserta->user->jabatan }}</small><br>
                                <small>Sekolah: {{ $peserta->user->sekolah }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($peserta->tgl)->format('d M Y') }}</td>
                            <td class="actions">
                                <div class="d-flex gap-2">
                                    <!-- Tombol "Terima" -->
                                    <button 
                                        class="btn btn-success btn-sm btn-update-status" 
                                        data-id="{{ $peserta->id_peserta }}" 
                                        data-status="1">
                                        <i class="bx bx-check-circle"></i> Terima
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada peserta mendaftar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Dropdown untuk filter
    const filterPeserta = document.getElementById('filterPeserta');
    const lolosTable = document.getElementById('lolosTable');
    const mendaftarTable = document.getElementById('mendaftarTable');

    filterPeserta.addEventListener('change', function () {
        if (filterPeserta.value === 'lolos') {
            lolosTable.style.display = 'block';
            mendaftarTable.style.display = 'none';
        } else {
            lolosTable.style.display = 'none';
            mendaftarTable.style.display = 'block';
        }
    });

    // Event listener untuk tombol update status
    document.querySelectorAll('.btn-update-status').forEach(button => {
        button.addEventListener('click', function () {
            const idPeserta = this.dataset.id;
            const status = this.dataset.status;

            Swal.fire({
                title: `Apakah Anda yakin ingin ${status == 1 ? 'menerima' : 'menolak'} peserta ini?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/diklat/peserta/${idPeserta}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ status }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message,
                                icon: 'success',
                            }).then(() => location.reload());
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses permintaan.',
                            icon: 'error',
                        });
                    });
                }
            });
        });
    });
});
</script>
@endsection
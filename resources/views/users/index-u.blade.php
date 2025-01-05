{{-- main.blade.php --}}
@extends('layouts/commonMaster')

@section('layoutContent')
    @include('layouts.sections.navbar.navbar-user')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .gradient-background {
            background: linear-gradient(to right, grey, black);
            opacity: 0.1;
        }

        .calendar-icon {
            background-color: black;
            color: #fff;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .custom-badge {
            background: linear-gradient(135deg, #ffdd57, #f6c23e);
            color: #212529;
            padding: 6px 12px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>

    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">SISTEM INFORMASI DIKLAT</h1>
            <p class="lead">Balai Teknologi Komunikasi Pendidikan D.I.Y</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container bg-light py-4">
        <h1 class="fs-4 fw-semibold mb-4">Diklat Tahun: {{ date('Y') }}</h1>

        @if($diklat && $diklat->status == 1)
            <div class="bg-white shadow rounded-lg p-4 d-flex align-items-center position-relative overflow-hidden">
                <!-- Gradient Background for Modern Look -->
                <div class="position-absolute top-0 start-0 w-100 h-100 gradient-background"></div>

                <!-- Icon Kalender -->
                <div class="flex-shrink-0 text-center z-1">
                    <div class="calendar-icon">
                        <div class="fs-3 fw-bold">{{ $diklat->tgl_mulai ? $diklat->tgl_mulai->format('d') : '--' }}</div>
                        <div class="fs-6">{{ $diklat->tgl_mulai ? $diklat->tgl_mulai->format('M') : '--' }}</div>
                    </div>
                </div>

                <!-- Informasi Diklat -->
                <div class="ms-4 flex-grow-1 z-1">
                    <h2 class="fs-5 fw-bold mb-3 text-dark">{{ $diklat->nama_diklat }}</h2>
                    <div class="text-muted small d-flex align-items-center mb-3">
                        <span class="badge custom-badge me-3 text-dark">
                            <i class='bx bx-user me-1'></i> {{ $diklat->pesertaMendaftar->count() }} Pendaftar
                        </span>
                        <span class="me-3">
                            <i class='bx bx-calendar me-1'></i>
                            {{ $diklat->tgl_mulai ? $diklat->tgl_mulai->format('d M') : '--' }} s/d
                            {{ $diklat->tgl_selesai ? $diklat->tgl_selesai->format('d M Y') : '--' }}
                        </span>
                        <span>
                            <i class='bx bx-group me-1'></i> Kuota: {{ $diklat->kuota }}
                        </span>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSyaratKetentuan">
                            <i class='bx bx-file me-1'></i> SYARAT & KETENTUAN
                        </button>
                        <a href="{{ route('daftar.diklat') }}" class="btn btn-primary">
                            <i class='bx bx-check-square me-1'></i> DAFTAR DIKLAT
                        </a>
                        <button type="button" class="btn btn-warning text-white">
                            <i class='bx bx-error me-1'></i>
                            {{ $diklat->pengumuman ? 'LIHAT PENGUMUMAN' : 'BELUM ADA PENGUMUMAN' }}
                        </button>
                    </div>
                </div>
            </div>
        @else
            <main class="container py-5 text-center">
                <p class="fs-4 fw-semibold">Diklat Tahun: <span class="fw-bold">{{ date('Y') }}</span></p>
                <div class="mt-5">
                    <img src="https://storage.googleapis.com/a1aa/image/uVuHkkWH0yKVAxK6BeGXk2M21UMFgjDfUpPk5HNo3TSYtD6TA.jpg"
                         alt="Illustration of a speaker and audience"
                         class="img-fluid rounded-circle shadow-sm"
                         style="width: 200px; height: 200px;" />
                    <p class="mt-4 fs-5">Belum ada data informasi diklat yang tersedia</p>
                </div>
            </main>
        @endif
    </main>

    <!-- Modal Syarat & Ketentuan -->
    <div class="modal fade" id="modalSyaratKetentuan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat & Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Berikut adalah syarat dan ketentuan untuk mengikuti diklat ini:</p>
                    @if($diklat && $diklat->syarat)
                        {!! $diklat->syarat !!}
                    @else
                        <ul>
                            <li>Peserta wajib mendaftar melalui platform resmi.</li>
                            <li>Peserta diwajibkan menyertakan identitas lengkap.</li>
                            <li>Kuota terbatas, pendaftaran bersifat first come first serve.</li>
                        </ul>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.sections.footer.footer-user')
@endsection
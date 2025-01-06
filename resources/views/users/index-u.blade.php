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

    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 1rem 0;
    }

    .page-item {
        margin: 0 5px;
    }

    .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        border-radius: 0.25rem;
        color: #007bff;
        text-decoration: none;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .page-link:hover {
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #ddd;
    }

    .page-item.active .page-link {
        color: #fff;
        background-color: #696cff;
        border-color: #696cff;
    }

    .page-item.disabled .page-link {
        color: #a5a6ab;
        pointer-events: none;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .page-link {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
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
    <h1 class="fs-4 fw-semibold mb-4">Diklat Aktif</h1>

    @if($diklatAktif->count() > 0)
    @foreach($diklatAktif as $diklat)
    <div class="bg-white shadow rounded-lg p-4 d-flex align-items-center position-relative overflow-hidden mb-3">
        <!-- Gradient Background -->
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
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSyaratKetentuan{{ $diklat->id }}">
                    <i class='bx bx-file me-1'></i> SYARAT & KETENTUAN
                </button>
                <a href="{{ route('users.daftar-diklat', ['id' => $diklat->id_diklat]) }}" class="btn btn-primary">
                    <i class='bx bx-check-square me-1'></i> Daftar Diklat
                </a>
                <button type="button" class="btn btn-warning text-white">
                    <i class='bx bx-error me-1'></i>
                    {{ $diklat->pengumuman ? 'LIHAT PENGUMUMAN' : 'BELUM ADA PENGUMUMAN' }}
                </button>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Paginasi -->
    <div class="card-footer d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0">
                @if ($diklatAktif->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><i class="tf-icon bx bx-chevron-left"></i></span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $diklatAktif->previousPageUrl() }}" aria-label="Previous">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                @endif

                @foreach ($diklatAktif->getUrlRange(1, $diklatAktif->lastPage()) as $page => $url)
                <li class="page-item {{ $diklatAktif->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                @if ($diklatAktif->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $diklatAktif->nextPageUrl() }}" aria-label="Next">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link"><i class="tf-icon bx bx-chevron-right"></i></span>
                </li>
                @endif
            </ul>
        </nav>
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
<div class="modal fade" id="modalSyaratKetentuan{{ $diklat->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Syarat & Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Berikut adalah syarat dan ketentuan untuk mengikuti diklat ini:</p>
                @if($diklat->syarat)
                {!! $diklat->syarat !!}
                @else
                <p class="text-muted fw-normal">Belum ada syarat dan ketentuan yang tersedia untuk diklat ini.</p>
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
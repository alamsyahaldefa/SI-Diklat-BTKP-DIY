
@extends('layouts/commonMaster')


<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">

<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

<style>
    .gradient-background {
        background: linear-gradient(to right, grey, black);
        opacity: 0.1;
    }

    /* Ensure icons retain original color on hover */
    i {
        transition: color 0.3s ease;
        color: white !important;
    }

    i:hover {
        color: white !important;
    }

    /* Card hover effect without affecting icons */
    .card:hover {
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        transform: scale(1.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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

    /* Buttons container styling */
    .buttons-container {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        width: 200px;
    }

    .buttons-container .btn {
        width: 100%;
    }
</style>

@section('layoutContent')
@include('layouts.sections.navbar.navbar-user')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />

<section class="bg-gradient-primary text-white py-5 position-relative">
    <div class="container text-center position-relative z-2">
        <h1 class="display-4 fw-bold mb-3">SISTEM INFORMASI DIKLAT</h1>
        <p class="lead mb-4">Balai Teknologi Komunikasi Pendidikan D.I.Y</p>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(135deg, rgba(20,30,48,0.85), rgba(36,59,85,0.85)), url('https://source.unsplash.com/1600x900/?technology,education'); background-size: cover; background-position: center; opacity: 1; z-index: 1;">
    </div>
</section>


<main class="container py-4">
    <h1 class="fs-4 fw-bold mb-4 text-black">Diklat Tahun: 2025</h1>

    @if($diklatAktif->count() > 0)
    <div class="row row-cols-1 g-4 mb-5">
        @foreach($diklatAktif as $diklat)
        <div class="col">
            <div class="card d-flex flex-row align-items-center p-3">
                <img class="card-img-left"
                    src="https://storage.googleapis.com/a1aa/image/uVuHkkWH0yKVAxK6BeGXk2M21UMFgjDfUpPk5HNo3TSYtD6TA.jpg"
                    alt="Diklat Image"
                    style="width: 150px; height: auto; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                <div class="card-body pb-1 flex-grow-1">
                    <h6 class="card-title text-dark fw-bold">{{ $diklat->nama_diklat }}</h6>
                    <div class="text-muted small mb-2">
                        <i class='bx bx-calendar me-1' style="color: black !important;"></i>
                        {{ $diklat->tgl_mulai ? $diklat->tgl_mulai->format('d M') : '--' }} s/d
                        {{ $diklat->tgl_selesai ? $diklat->tgl_selesai->format('d M Y') : '--' }}
                    </div>
                    <div class="text-muted small mb-3">
                        <i class='bx bx-group me-1' style="color: black !important;"></i> Kuota: {{ $diklat->kuota }}
                    </div>
                    <small class="text-muted" style="font-size: 0.8rem;">{{ $diklat->pesertaMendaftar->count() }}
                        Pendaftar</small>
                </div>
                <div class="buttons-container">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalSyaratKetentuan{{ $diklat->id }}">
                        <i class='bx bx-file me-1'></i> SYARAT & KETENTUAN
                    </button>
                    <a href="{{ route('users.daftar-diklat', ['id' => $diklat->id_diklat]) }}"
                        class="btn btn-sm btn-primary">
                        <i class='bx bx-check-square me-1'></i> DAFTAR DIKLAT
                    </a>
                    @if($diklat->pengumuman == 1 && !empty($diklat->surat))
                    <a href="{{ asset('storage/surat_diklat/' . $diklat->surat) }}"
                        class="btn btn-sm btn-warning text-white" target="_blank">
                        <i class='bx bx-error me-1'></i> LIHAT PENGUMUMAN
                    </a>
                    @else
                    <button type="button" class="btn btn-sm btn-warning text-white" disabled
                        style="opacity: 0.65; cursor: not-allowed;">
                        <i class='bx bx-error me-1'></i> BELUM ADA PENGUMUMAN
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Syarat & Ketentuan -->
        <div class="modal fade" id="modalSyaratKetentuan{{ $diklat->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Syarat & Ketentuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Berikut adalah syarat dan ketentuan untuk mengikuti diklat ini:</p>
                        @if($diklat->syarat)
                        {!! $diklat->syarat !!}
                        @else
                        <p class="text-muted fw-normal">Belum ada syarat dan ketentuan yang tersedia untuk diklat ini.
                        </p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $diklatAktif->links('pagination::bootstrap-4') }}
    </div>
    @else
    <main class="container py-5 text-center">
        <p class="fs-4 fw-semibold">Diklat Tahun: <span class="fw-bold">{{ date('Y') }}</span></p>
        <div class="mt-5">
            <img src="https://storage.googleapis.com/a1aa/image/uVuHkkWH0yKVAxK6BeGXk2M21UMFgjDfUpPk5HNo3TSYtD6TA.jpg"
                alt="Illustrati" class="img-fluid rounded-circle shadow-sm" style="width: 200px; height: 200px;">
            <p class="mt-4 fs-5">Belum ada data informasi diklat</p>
        </div>
    </main>
    @endif

</main>

@include('layouts.sections.footer.footer-user')
@endsection
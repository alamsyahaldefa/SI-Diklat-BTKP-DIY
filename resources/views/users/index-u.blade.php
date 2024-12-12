<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Diklat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  </head>


  
  <body class="bg-light text-dark">
    <!-- Header -->
    <header class="bg-white py-4 shadow-sm">
      <div class="container text-center">
      <img src="{{ asset('assets/img/branding/logo-btkp.png') }}" alt="Logo BTKP" style="width: 100px; height:auto; img-fluid">
      </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-primary text-white py-5">
      <div class="container text-center">
        <h1 class="display-4 fw-bold">SISTEM INFORMASI DIKLAT</h1>
        <p class="lead">Balai Teknologi Komunikasi Pendidikan D.I.Y</p>
      </div>
    </section>

    <main class="container bg-light py-4">
    <h1 class="fs-4 fw-semibold mb-4">Diklat Tahun: 2024</h1>
    <div class="bg-white shadow-sm rounded-lg p-4 d-flex align-items-center">
        <!-- Icon Kalender -->
        <div class="flex-shrink-0 text-center">
            <div class="bg-dark text-white p-2 rounded">
                <div class="fs-4 fw-bold">11</div>
                <div class="fs-6">Dec</div>
            </div>
        </div>
        <!-- Informasi Diklat -->
        <div class="ms-4 flex-grow-1">
            <h2 class="fs-5 fw-bold mb-2">TES</h2>
            <div class="text-muted small d-flex align-items-center mb-3">
                <span class="badge bg-warning text-dark me-2">
                    <i class="fas fa-user me-1"></i> 0 Pendaftar
                </span>
                <span class="me-3">
                    <i class="far fa-calendar-alt me-1"></i> 11 Dec s/d 13 Dec 2024
                </span>
                <span>
                    <i class="fas fa-users me-1"></i> Kuota: 30
                </span>
            </div>
            <!-- Tombol Aksi -->
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-file-alt me-1"></i> SYARAT & KETENTUAN
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-clipboard-check me-1"></i> DAFTAR DIKLAT
                </button>
                <button type="button" class="btn btn-warning text-white">
                    <i class="fas fa-exclamation-circle me-1"></i> BELUM ADA PENGUMUMAN
                </button>
            </div>
        </div>
    </div>
</main>




    <!-- Main Content -->
    <main class="container py-5 text-center">
      <p class="fs-4 fw-semibold">Diklat Tahun: <span class="fw-bold">2024</span></p>
      <div class="mt-5">
        <img
          src="https://storage.googleapis.com/a1aa/image/uVuHkkWH0yKVAxK6BeGXk2M21UMFgjDfUpPk5HNo3TSYtD6TA.jpg"
          alt="Illustration of a speaker and audience"
          class="img-fluid rounded-circle shadow-sm"
          style="width: 200px; height: 200px;"
        />
        <p class="mt-4 fs-5">Belum ada data informasi diklat</p>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white py-4 border-top">
      <div class="container text-center">
        <div class="row gy-4">
          <div class="col-6 col-md-3">
            <i class="fas fa-envelope text-primary fs-2"></i>
            <p class="mt-2 mb-0">Email</p>
            <p class="text-muted">info@btkp-diy.or.id</p>
          </div>
          <div class="col-6 col-md-3">
            <i class="fab fa-facebook text-primary fs-2"></i>
            <p class="mt-2 mb-0">Facebook</p>
            <p class="text-muted">BTKP DIY</p>
          </div>
          <div class="col-6 col-md-3">
            <i class="fab fa-instagram text-primary fs-2"></i>
            <p class="mt-2 mb-0">Instagram</p>
            <p class="text-muted">@btkpdiy</p>
          </div>
          <div class="col-6 col-md-3">
            <i class="fas fa-phone text-primary fs-2"></i>
            <p class="mt-2 mb-0">Telp</p>
            <p class="text-muted">(0274) 517327</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

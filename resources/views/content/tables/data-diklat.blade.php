@extends('layouts/contentNavbarLayout')

@section('title', 'Data Diklat -')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-2">
  <h3>Data Diklat</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Administrator</a>
      </li>
      <li class="breadcrumb-item active">Data Diklat</li>
    </ol>
  </nav>
</div>

<div>
  <div class="row justify-space-between">
    <div>
      <button type="button" class="btn btn-outline-primary"
        onclick="window.location.href='{{ route('tambah-diklat') }}'">
        <i class="bx bx-plus"></i> Tambah Diklat
      </button>

      <button type="button" class="btn btn-outline-secondary" onclick="window.location.reload()">
        <i class="bx bx-refresh"></i>
      </button>
    </div>

    <hr class="my-2">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-hover w-100">
          <thead>
            <tr>
              <th><strong>No</strong></th>
              <th><strong>Nama Diklat</strong></th>
              <th><strong>Tanggal Diklat</strong></th>
              <th><strong>Peserta Terdaftar</strong></th>
              <th><strong>Status</strong></th>
              <th><strong>Actions</strong></th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse($diklats as $index => $diklat)
            <tr>
              <td><small>{{ $index + 1 }}</small></td>
              <td><small>{{ $diklat->nama_diklat }}</small></td>
              <td><small>{{ $diklat->tgl_mulai->format('d M') }} - {{ $diklat->tgl_selesai->format('d M Y') }}</small></td>
              <td>
                <small>
                  {{ $diklat->kuota }} Peserta
                </small>
              </td>
              <td>
                <div class="btn-group">
                  <!-- Tombol Dropdown Status Diklat -->
                  <button type="button"
                    class="btn {{ $diklat->status ? 'btn-success' : 'btn-danger' }} dropdown-toggle btn-sm"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $diklat->status ? 'Dibuka' : 'Ditutup' }}
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#"
                        class="dropdown-item"
                        onclick="confirmStatusChange(event, '{{ route('diklat.updateStatus', ['id' => $diklat->id_diklat, 'status' => 1]) }}', 'Dibuka');">
                        Dibuka
                      </a>
                    </li>
                    <li>
                      <a href="#"
                        class="dropdown-item"
                        onclick="confirmStatusChange(event, '{{ route('diklat.updateStatus', ['id' => $diklat->id_diklat, 'status' => 0]) }}', 'Ditutup');">
                        Ditutup
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
              <td class="actions">
                <div class="d-flex gap-2 justify-content-center">
                  <!-- Rekap Data -->
                  <a href="{{ route('diklat.rekap', $diklat->id_diklat) }}"
                    class="btn btn-sm btn-outline-primary tooltip-custom">
                    <i class="bx bx-message"></i>
                    <span class="tooltip-text">Rekap data diklat</span>
                  </a>

                  <!-- Edit Data -->
                  <a href="{{ route('diklat.edit', $diklat->id_diklat) }}"
                    class="btn btn-sm btn-outline-warning tooltip-custom">
                    <i class="bx bx-edit-alt"></i>
                    <span class="tooltip-text">Edit data diklat</span>
                  </a>

                  <!-- Kelola Peserta -->
                  <a href="{{ route('diklat.peserta', $diklat->id_diklat) }}"
                    class="btn btn-sm btn-outline-info tooltip-custom">
                    <i class="bx bx-user"></i>
                    <span class="tooltip-text">Kelola peserta diklat</span>
                  </a>

                  <!-- Hapus Data -->
                  <a href="#"
                    onclick="deleteDiklat('{{ route('diklat.destroy', $diklat->id_diklat) }}', {{ $diklat->id_diklat }})"
                    class="btn btn-sm btn-outline-danger tooltip-custom">
                    <i class="bx bx-trash"></i>
                    <span class="tooltip-text">Hapus data diklat</span>
                  </a>
                  <!-- Form DELETE -->
                  <form id="delete-form-{{ $diklat->id_diklat }}"
                    action="{{ route('diklat.destroy', $diklat->id_diklat) }}"
                    method="POST"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                  </form>

                  <!-- Toggle Pengumuman -->
                  <a href="#"
                    onclick="togglePengumuman({{ $diklat->id_diklat }})"
                    class="btn btn-sm btn-outline-success tooltip-custom">
                    <i class="bx bx-volume-full"></i>
                    <span class="tooltip-text">Terbitkan pengumuman diklat</span>
                  </a>

                  <!-- Toggle Quiz -->
                  <a href="#"
                    onclick="toggleQuiz({{ $diklat->id_diklat }})"
                    class="btn btn-sm btn-outline-secondary tooltip-custom">
                    <i class="bx bx-book"></i>
                    <span class="tooltip-text">Terbitkan kuesioner diklat</span>
                  </a>

                  <!-- Generate Sertifikat -->
                  <a href="#"
                    onclick="generateCertificates({{ $diklat->id_diklat }})"
                    class="btn btn-sm btn-outline-primary tooltip-custom">
                    <i class="bx bx-certification"></i>
                    <span class="tooltip-text">  Generate sertifikat untuk peserta yang lulus</span>
                  </a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">Tidak ada data diklat</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer d-flex justify-content-center">
        <nav aria-label="Page navigation">
          <ul class="pagination pagination-sm mb-0">
            @if ($diklats->onFirstPage())
            <li class="page-item disabled">
              <span class="page-link"><i class="tf-icon bx bx-chevron-left"></i></span>
            </li>
            @else
            <li class="page-item">
              <a class="page-link" href="{{ $diklats->previousPageUrl() }}" aria-label="Previous">
                <i class="tf-icon bx bx-chevron-left"></i>
              </a>
            </li>
            @endif

            @foreach ($diklats->getUrlRange(1, $diklats->lastPage()) as $page => $url)
            <li class="page-item {{ $diklats->currentPage() == $page ? 'active' : '' }}">
              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endforeach

            @if ($diklats->hasMorePages())
            <li class="page-item">
              <a class="page-link" href="{{ $diklats->nextPageUrl() }}" aria-label="Next">
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
    </div>

    <!-- Modal Kelola Peserta -->
    <div class="modal fade" id="pesertaModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Kelola Peserta Diklat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-hover" id="pesertaTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Status</th>
                    <th>Sertifikat</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection

    <style>
      .pagination {
        margin: 0;
      }

      .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
      }

      .pagination .page-link i {
        font-size: 1rem;
        line-height: 1;
      }

      .pagination .active .page-link {
        background-color: #696cff;
        border-color: #696cff;
      }

      .pagination .disabled .page-link {
        color: #a5a6ab;
      }

      .tooltip-custom {
        position: relative;
      }

      .tooltip-text {
        visibility: hidden;
        background-color: #2d3436;
        color: #fff;
        text-align: center;
        padding: 6px 10px;
        border-radius: 6px;
        position: absolute;
        z-index: 1;
        bottom: 135%;
        left: 50%;
        transform: translateX(-50%);
        font-size: 14px;
        font-weight: 500;
        min-width: 150px;
        line-height: 1.2  ;
        opacity: 0;
        transition: opacity 0.3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      }

      .tooltip-text::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #2d3436 transparent transparent transparent;
      }

      .tooltip-custom:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
      }
    </style>
    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap Modal Script -->
    <script>
      // SweetAlert untuk perubahan status
      function confirmStatusChange(event, url, statusLabel) {
        event.preventDefault();

        Swal.fire({
          title: "Apakah Anda yakin?",
          text: `Status akan diubah menjadi "${statusLabel}".`,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, Ubah!",
          cancelButtonText: "Batal"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url; // Redirect jika dikonfirmasi
          }
        });
      }

      // Konfirmasi hapus diklat
      function deleteDiklat(url, id_diklat) {
        Swal.fire({
          title: "Apakah Anda yakin?",
          text: "Data ini akan dihapus dan tidak dapat dipulihkan.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#6c757d",
          confirmButtonText: "Ya, Hapus!",
          cancelButtonText: "Batal"
        }).then((result) => {
          if (result.isConfirmed) {
            // Kirim request DELETE dengan AJAX
            $.ajax({
              url: url,
              type: "POST",
              headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              data: {
                _method: "DELETE",
              },
              success: function(response) {
                Swal.fire({
                  title: "Berhasil!",
                  text: "Data telah dihapus.",
                  icon: "success",
                  timer: 1500,
                }).then(() => {
                  window.location.reload();
                });
              },
              error: function(xhr) {
                Swal.fire("Error!", "Terjadi kesalahan saat menghapus data.", "error");
              }
            });
          }
        });
      }

      // Fungsi untuk toggle pengumuman
      function togglePengumuman(id_diklat) {
        fetch(`/diklat/${id_diklat}/toggle-pengumuman`, {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
          })
          .then((response) => response.json())
          .then((data) => {
            Swal.fire({
              title: "Berhasil!",
              text: data.message,
              icon: "success",
              timer: 1500
            });
          });
      }

      // Fungsi untuk toggle kuis
      function toggleQuiz(id_diklat) {
        fetch(`/diklat/${id_diklat}/toggle-quiz`, {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
          })
          .then((response) => response.json())
          .then((data) => {
            Swal.fire({
              title: "Berhasil!",
              text: data.message,
              icon: "success",
              timer: 1500
            });
          });
      }

      // Fungsi untuk generate sertifikat
      function generateCertificates(id_diklat) {
        fetch(`/diklat/${id_diklat}/generate-certificates`, {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
          })
          .then((response) => response.json())
          .then((data) => {
            Swal.fire({
              title: "Berhasil!",
              text: data.message,
              icon: "success",
              timer: 1500
            });
          });
      }
    </script>
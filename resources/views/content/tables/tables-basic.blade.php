@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-2">
  <h3>Data Diklat</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
      <li class="breadcrumb-item">
        <a href="javascript:void(0);">Administrator</a>
      </li>
      <li class="breadcrumb-item active">Data Diklat</li>
    </ol>
  </nav>
</div>


<div>
  <div class="row justify-space-between">
    <div>
      <!-- Tombol "Tambah Diklat" dengan ikon plus -->
      <button type="button" class="btn btn-outline-primary"
        onclick="window.location.href='{{ route('form-layouts-horizontal') }}'">
        <i class="bx bx-plus"></i> Tambah Diklat
      </button>


      <!-- Tombol "Refresh" dengan ikon refresh saja -->
      <button type="button" class="btn btn-outline-secondary">
        <i class="bx bx-refresh"></i>
      </button>
    </div>

    <div>
      <hr class="my-1">
      <form class="d-flex">
        <div class="input-group">
          <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
          <input type="text" class="form-control" placeholder="Search..." />
        </div>
      </form>
    </div>
  </div>
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
          <th><strong>Jumlah Peserta</strong></th>
          <th><strong>Status</strong></th>
          <th><strong>Actions</strong></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <!-- Row 1 -->
        <tr>
          <td><small>1</small></td>
          <td><small>BIMTEK TEKNOLOGI btkp 2024</small></td>
          <td><small>10 Nov - 12 Nov 2024</small></td>
          <td><small>100 Peserta</small></td>
          <td>
            <!-- Status Dropdown -->
            <div class="btn-group">
              <button type="button" id="statusButton1" class="btn btn-success dropdown-toggle btn-sm"
                data-bs-toggle="dropdown" aria-expanded="false">
                Dibuka
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeStatus('statusButton1', 'Dibuka')">Dibuka</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeStatus('statusButton1', 'Ditutup')">Ditutup</a></li>
              </ul>
            </div>
          </td>
          <td class="actions">
            <div class="d-flex gap-2 justify-content-center">
              <!-- Button Rekap Data -->
              <a href="{{ route('rekap.data') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap data diklat">
                <i class="bx bx-message"></i>
              </a>

              <!-- Button Edit Diklat -->
              <a href="javascript:void(0);" onclick="editDiklat()" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Edit data diklat dan upload surat pengumuman">
                <i class="bx bx-edit-alt"></i>
              </a>

              <script>
                function editDiklat() {
                  // Mengarahkan pengguna ke URL edit diklat
                  window.location.href = "{{ route('edit-diklat') }}";
                }
              </script>

              <!-- Tombol Hapus Diklat -->
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus diklat" id="hapusDiklatBtn1">
                <i class="bx bx-trash"></i>
              </a>

              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              <script>
                document.getElementById('hapusDiklatBtn1').addEventListener('click', function () {
                  Swal.fire({
                    title: "Apakah anda yakin ingin menghapus diklat ini?",
                    text: "Data diklat ini tidak dapat diakses lagi",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire({
                        title: "Deleted!",
                        text: "Data diklat telah berhasil dihapus.",
                        icon: "success"
                      });
                      // Tambahkan kode untuk menghapus diklat atau melakukan aksi lain di sini
                    }
                  });
                });
              </script>

              <!-- Button Pengumuman -->
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik tombol ini jika ingin menerbitkan pengumuman peserta lolos untuk diklat ini">
                <i class="bx bx-volume-full"></i>
              </a>

              <!-- Button Kuisioner -->
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik tombol ini jika ingin menerbitkan pengisian kuisioner diklat ini">
                <i class="bx bx-book"></i>
              </a>
            </div>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr>
          <td><small>2</small></td>
          <td><small>PELATIHAN SAC Balai Tekkomdik</small></td>
          <td><small>10 Nov - 12 Nov 2024</small></td>
          <td><small>100 Peserta</small></td>
          <td>
            <!-- Status Dropdown -->
            <div class="btn-group">
              <button type="button" id="statusButton2" class="btn btn-success dropdown-toggle btn-sm"
                data-bs-toggle="dropdown" aria-expanded="false">
                Dibuka
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeStatus('statusButton2', 'Dibuka')">Dibuka</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeStatus('statusButton2', 'Ditutup')">Ditutup</a></li>
              </ul>
            </div>
          </td>
          <td class="actions">
            <div class="d-flex gap-2 justify-content-center">
              <a href="{{ route('rekap.data') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap data diklat">
                <i class="bx bx-message"></i>
              </a>

              <a href="javascript:void(0);" onclick="editDiklat()" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit data diklat dan upload surat pengumuman">
                <i class="bx bx-edit-alt"></i>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus diklat" id="hapusDiklatBtn2">
                <i class="bx bx-trash"></i>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik tombol ini jika ingin menerbitkan pengumuman peserta lolos untuk diklat ini">
                <i class="bx bx-volume-full"></i>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik tombol ini jika ingin menerbitkan pengisian kuisioner diklat ini">
                <i class="bx bx-book"></i>
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- JavaScript to Change Status Button -->
<script>
  function changeStatus(buttonId, status) {
    var button = document.getElementById(buttonId);
    button.innerHTML = status;

    // Update button class based on status
    if (status === 'Dibuka') {
      button.classList.remove('btn-danger');
      button.classList.add('btn-success');
    } else if (status === 'Ditutup') {
      button.classList.remove('btn-success');
      button.classList.add('btn-danger');
    }
  }
</script>


@endsection
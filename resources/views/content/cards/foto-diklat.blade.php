@extends('layouts/contentNavbarLayout')

@section('title', 'Cards basic   - UI elements')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Dokumentasi Diklat</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-style1 mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}">Administrator</a>
        </li>
        <li class="breadcrumb-item active">Foto Diklat</li>
      </ol>
    </nav>
  </div>

<!-- Button untuk memunculkan modal statis -->
<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambahFotoStatis">
  Tambah Foto
</button>

<!-- Modal Vertically Centered Statis -->
<div class="modal fade" id="modalTambahFotoStatis" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahFotoStatisTitle">Tambah Foto Diklat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div>
          <label for="defaultFormControlInput" class="form-label">Nama Diklat</label>
          <input type="text" class="form-control" id="defaultFormControlInput"/>
        </div>
        </div>
        <div class="row g-2">
        <div class="col mb-3">
          <label for="html5-date-input" class="col-md-2 col-form-label">Tanggal Mulai</label>
          <div class="col-md-10">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
          </div>
        </div>
          <div class="col mb-3">
          <label for="html5-date-input" class="col-md-2 col-form-label">Tanggal Selesai</label>
          <div class="col-md-10">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
          </div>
        </div>

        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Upload Foto</label>
          <input class="form-control" type="file" id="formFile">
        </div>
      </div>
      <div class="modal-footer ">
      <button type="button" class="btn rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
      <button type="button" class="btn rounded-pill btn-outline-primary">Kirim</button>
      </div>
    </div>
  </div>
</div>


<!-- Grid Card -->
<div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
<div class="col">
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}">
    <div class="card-body pb-1">
      <h5 class="card-title">Diklat 1</h5>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center pt-1">
      <small class="text-muted" style="font-size: 0.8rem;">03-08-2024 s/d 05-08-2024</small>
      <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalEditFoto">
        <i class="bx bx-edit"></i>
      </button>
    </div>
  </div>
</div>

<!-- Modal Edit Foto Diklat -->
<div class="modal fade" id="modalEditFoto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditFotoTitle">Edit Foto Diklat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div>
            <label for="editNamaDiklat" class="form-label">Nama Diklat</label>
            <input type="text" class="form-control" id="editNamaDiklat" value="Diklat 1"/>
          </div>
        </div>
        <div class="row g-2 mt-3">
          <div class="col mb-3">
            <label for="editTanggalMulai" class="col-form-label">Tanggal Mulai</label>
            <input class="form-control" type="date" id="editTanggalMulai" value="2024-08-03" />
          </div>
          <div class="col mb-3">
            <label for="editTanggalSelesai" class="col-form-label">Tanggal Selesai</label>
            <input class="form-control" type="date" id="editTanggalSelesai" value="2024-08-05" />
          </div>
        </div>
        <div class="mb-3">
          <label for="editFormFile" class="form-label">Upload Foto Baru</label>
          <input class="form-control" type="file" id="editFormFile">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn rounded-pill btn-outline-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>



  <div class="col">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/13.jpg')}}">
      <div class="card-body pb-1">
        <h5 class="card-title">Diklat 2</h5>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center pt-1">
        <small class="text-muted" style="font-size: 0.8rem;">03-08-2024 s/d 05-08-2024</small>
        <button class="btn btn-sm btn-outline-secondary">
          <i class="bx bx-edit"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/4.jpg')}}">
      <div class="card-body pb-1">
        <h5 class="card-title">Diklat 3</h5>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center pt-1">
        <small class="text-muted" style="font-size: 0.8rem;">03-08-2024 s/d 05-08-2024</small>
        <button class="btn btn-sm btn-outline-secondary">
          <i class="bx bx-edit"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/18.jpg')}}">
      <div class="card-body pb-1">
        <h5 class="card-title">Diklat 4</h5>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center pt-1">
        <small class="text-muted" style="font-size: 0.8rem;">03-08-2024 s/d 05-08-2024</small>
        <button class="btn btn-sm btn-outline-secondary">
          <i class="bx bx-edit"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/19.jpg')}}">
      <div class="card-body pb-1">
        <h5 class="card-title">Diklat 5</h5>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center pt-1">
        <small class="text-muted" style="font-size: 0.8rem;">03-08-2024 s/d 05-08-2024</small>
        <button class="btn btn-sm btn-outline-secondary">
          <i class="bx bx-edit"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/20.jpg')}}">
      <div class="card-body pb-1">
        <h5 class="card-title">Diklat 6</h5>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center pt-1">
        <small class="text-muted" style="font-size: 0.8rem;">03-08-2024 s/d 05-08-2024</small>
        <button class="btn btn-sm btn-outline-secondary">
          <i class="bx bx-edit"></i>
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

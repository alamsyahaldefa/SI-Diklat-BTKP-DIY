@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Diklat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-2">
  <h3>Edit Diklat</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
      <li class="breadcrumb-item">
        <a href="javascript:void(0);">Administrator</a>
      </li>
      <li class="breadcrumb-item">
        <a onclick="window.location.href='{{ route('tables-basic') }}'">Data Diklat</a>
      </li>
      <li class="breadcrumb-item active">Edit Diklat</li>
    </ol>
  </nav>
</div>
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Diklat</h5> <small class="text-muted float-end"></small>
    </div>
    <div class="card-body mt-2">
      <form>
        <!-- Nama Diklat -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Nama Diklat</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
              <input type="text" id="basic-icon-default-company" class="form-control" 
                placeholder="Masukkan Nama Diklat" value="BIMTEK TEKNOLOGI btkp 2024" 
                aria-label="" aria-describedby="basic-icon-default-company2" />
            </div>
          </div>
        </div>

        <!-- Tanggal Mulai -->
        <div class="mb-3 row">
          <label for="html5-date-input-start" class="col-md-2 col-form-label">Tanggal Mulai</label>
          <div class="col-md-10">
            <input class="form-control" type="date" id="html5-date-input-start" value="2024-11-10" />
          </div>
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-3 row">
          <label for="html5-date-input-end" class="col-md-2 col-form-label">Tanggal Selesai</label>
          <div class="col-md-10">
            <input class="form-control" type="date" id="html5-date-input-end" value="2024-11-12" />
          </div>
        </div>

        <!-- Kuota Peserta -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kuota Peserta</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
              <input type="text" class="form-control" placeholder="Masukkan Kuota Peserta" value="100 Peserta" />
            </div>
            <div class="form-text">Format Penulisan: 25 Peserta</div>
          </div>
        </div>

        <!-- Syarat & Ketentuan -->
        <div class="row mb-3">
          <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Syarat & Ketentuan</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Syarat dan ketentuan diklat masih perlu diisi...</textarea>
          </div>
        </div>

        <!-- Buttons -->
        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('tables-basic') }}'">Back</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

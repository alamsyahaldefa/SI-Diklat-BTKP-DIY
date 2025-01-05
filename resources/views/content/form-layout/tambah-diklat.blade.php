@extends('layouts/contentNavbarLayout')

@section('title', ' Tambah Diklat -')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-2">
  <h3>Tambah Diklat</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Administrator</a>
      </li>
      <li class="breadcrumb-item active">Tambah Diklat</li>
    </ol>
  </nav>
</div>

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Diklat</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('diklat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="nama_diklat">Nama Diklat</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-buildings"></i></span>
              <input type="text" id="nama_diklat" name="nama_diklat"
                class="form-control @error('nama_diklat') is-invalid @enderror"
                value="{{ old('nama_diklat') }}" />
            </div>
            @error('nama_diklat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Periode Diklat</label>
          <div class="col-sm-5">
            <input type="date" name="tgl_mulai" class="form-control @error('tgl_mulai') is-invalid @enderror"
              value="{{ old('tgl_mulai') }}" />
            @error('tgl_mulai')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-sm-5">
            <input type="date" name="tgl_selesai" class="form-control @error('tgl_selesai') is-invalid @enderror"
              value="{{ old('tgl_selesai') }}" />
            @error('tgl_selesai')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="kuota">Kuota</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-user"></i></span>
              <input type="number" id="kuota" name="kuota"
                class="form-control @error('kuota') is-invalid @enderror"
                value="{{ old('kuota') }}" />
            </div>
            @error('kuota')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Dokumen</label>
          <div class="col-sm-10">
            <input type="file" name="surat" class="form-control @error('surat') is-invalid @enderror" />
            @error('surat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Upload file PDF, DOC, atau DOCX (max: 2MB)</div>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Foto</label>
          <div class="col-sm-10">
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" />
            @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Upload file JPG, JPEG, atau PNG (max: 2MB)</div>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Syarat & Ketentuan</label>
          <div class="col-sm-10">
            <textarea name="syarat" class="form-control @error('syarat') is-invalid @enderror"
              rows="4">{{ old('syarat') }}</textarea>
            @error('syarat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('data-diklat') }}" class="btn btn-secondary">Batal</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
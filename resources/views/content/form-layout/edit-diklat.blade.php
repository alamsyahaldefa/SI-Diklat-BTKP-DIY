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
        <a href="{{ route('data-diklat') }}">Data Diklat</a>
      </li>
      <li class="breadcrumb-item active">Edit Diklat</li>
    </ol>
  </nav>
</div>
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Diklat</h5>
    </div>
    <div class="card-body mt-2">
      <!-- Form Start -->
      <form action="{{ route('diklat.update', $diklat->id_diklat) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tampilkan Error Validasi -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Nama Diklat -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="nama_diklat">Nama Diklat</label>
          <div class="col-sm-10">
            <input type="text" name="nama_diklat" id="nama_diklat" class="form-control"
              value="{{ old('nama_diklat', $diklat->nama_diklat) }}" required>
          </div>
        </div>

        <!-- Tanggal Mulai -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="tgl_mulai">Tanggal Mulai</label>
          <div class="col-sm-10">
            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control"
              value="{{ old('tgl_mulai', $diklat->tgl_mulai->format('Y-m-d')) }}" required>
          </div>
        </div>

        <!-- Tanggal Selesai -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="tgl_selesai">Tanggal Selesai</label>
          <div class="col-sm-10">
            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control"
              value="{{ old('tgl_selesai', $diklat->tgl_selesai->format('Y-m-d')) }}" required>
          </div>
        </div>

        <!-- Kuota Peserta -->
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="kuota">Kuota Peserta</label>
          <div class="col-sm-10">
            <input type="number" name="kuota" id="kuota" class="form-control"
              value="{{ old('kuota', $diklat->kuota) }}" required>
          </div>
        </div>

        <!-- Syarat & Ketentuan -->
        <div class="row mb-3">
          <label for="syarat" class="col-sm-2 col-form-label">Syarat & Ketentuan</label>
          <div class="col-sm-10">
            <textarea name="syarat" id="syarat" class="form-control" rows="4">{{ old('syarat', $diklat->syarat) }}</textarea>
          </div>
        </div>

        <!-- File Surat -->
        <div class="row mb-3">
          <label for="surat" class="col-sm-2 col-form-label">File Surat Undangan</label>
          <div class="col-sm-10">
            <input type="file" name="surat" id="surat" class="form-control">
            @if ($diklat->surat)
            <small>File saat ini: <a href="{{ asset('storage/surat_diklat/' . $diklat->surat) }}" target="_blank">Lihat File</a></small>
            @endif
          </div>
        </div>

        <!-- File Foto -->
        <div class="row mb-3">
          <label for="foto" class="col-sm-2 col-form-label">Foto Diklat</label>
          <div class="col-sm-10">
            <input type="file" name="foto" id="foto" class="form-control">
            @if ($diklat->foto)
            <small>Foto saat ini: <img src="{{ asset('storage/foto_diklat/' . $diklat->foto) }}" alt="Foto Diklat" style="max-height: 100px;"></small>
            @endif
          </div>
        </div>

        <!-- Buttons -->
        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('data-diklat') }}'">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>

      <!-- Form End -->
    </div>
  </div>
</div>
@endsection
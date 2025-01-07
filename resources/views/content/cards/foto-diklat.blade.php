@extends('layouts/contentNavbarLayout')

@section('title', 'Dokumentasi Foto Diklat')

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

<div class="row row-cols-1 row-cols-md-3 g-4">
   @if(isset($diklat) && $diklat->count() > 0)
       @foreach($diklat as $item)
           <div class="col">
               <div class="card h-100">
                   @if($item->foto)
                       @php
                           $isNewFile = Storage::disk('public')->exists('foto_diklat/' . $item->foto);
                           $imagePath = $isNewFile 
                               ? Storage::url('foto_diklat/' . $item->foto)  
                               : asset('assets/img/diklat/' . $item->foto);   
                       @endphp
                       <img class="card-img-top" 
                            src="{{ $imagePath }}" 
                            alt="{{ $item->nama_diklat }}"
                            style="height: 200px; object-fit: cover;"
                            onerror="this.onerror=null; this.src='{{ asset('assets/img/elements/no-image.jpg') }}'">
                   @else
                       <div class="bg-light d-flex align-items-center justify-content-center" 
                            style="height: 200px;">
                           <span class="text-muted">
                               <i class='bx bx-image-alt' style="font-size: 3rem;"></i>
                               <br>
                               Tidak ada foto
                           </span>
                       </div>
                   @endif
                   
                   <div class="card-body">
                       <h5 class="card-title" style="font-size: 1rem;">
                           {{ $item->nama_diklat }}
                       </h5>
                       <p class="card-text">
                           <small class="text-muted">
                               {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d-m-Y') }}
                           </small>
                       </p>
                   </div>
                   <div class="card-footer">
                       <div class="d-flex justify-content-end">
                           <button type="button" 
                                   class="btn btn-sm btn-outline-secondary" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#modalEditFoto"
                                   data-id="{{ $item->id_diklat }}"
                                   data-nama="{{ $item->nama_diklat }}"
                                   data-mulai="{{ \Carbon\Carbon::parse($item->tgl_mulai)->format('Y-m-d') }}"
                                   data-selesai="{{ \Carbon\Carbon::parse($item->tgl_selesai)->format('Y-m-d') }}">
                               <i class="bx bx-edit"></i>
                           </button>
                       </div>
                   </div>
               </div>
           </div>
       @endforeach
   @else
       <div class="col-12">
           <div class="alert alert-info">
               <i class='bx bx-info-circle me-2'></i>
               Belum ada data diklat yang tersedia.
           </div>
       </div>
   @endif
</div>

<!-- Modal Edit Foto -->
<div class="modal fade" id="modalEditFoto" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
           <form id="formEditFoto" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="modal-header">
                   <h5 class="modal-title">Edit Foto Diklat</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row">
                       <div class="mb-3">
                           <label for="editNamaDiklat" class="form-label">Nama Diklat</label>
                           <input type="text" class="form-control" id="editNamaDiklat" readonly/>
                       </div>
                   </div>
                   <div class="row g-2">
                       <div class="col mb-3">
                           <label for="editTanggalMulai" class="col-form-label">Tanggal Mulai</label>
                           <input class="form-control" type="date" id="editTanggalMulai" readonly/>
                       </div>
                       <div class="col mb-3">
                           <label for="editTanggalSelesai" class="col-form-label">Tanggal Selesai</label>
                           <input class="form-control" type="date" id="editTanggalSelesai" readonly/>
                       </div>
                   </div>
                   <div class="mb-3">
                       <label for="editFormFile" class="form-label">Upload Foto Baru</label>
                       <input class="form-control" type="file" id="editFormFile" name="foto" accept="image/*">
                       <div class="mt-2">
                           <img id="imagePreview" src="" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;" class="mt-2 rounded">
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                   <button type="submit" class="btn rounded-pill btn-outline-primary">Simpan Perubahan</button>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection

@section('page-script')
<script>
$(document).ready(function() {
   // Handle modal data
    $('#modalEditFoto').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var nama = button.data('nama');
      var mulai = button.data('mulai');
      var selesai = button.data('selesai');
      
      var modal = $(this);
      modal.find('#editNamaDiklat').val(nama);
      modal.find('#editTanggalMulai').val(mulai);
      modal.find('#editTanggalSelesai').val(selesai);
      modal.find('#formEditFoto').attr('action', '/diklat/' + id + '/update-foto');  // URL sesuaikan dengan route
  });

   // Handle image preview
   $('#editFormFile').change(function() {
       const file = this.files[0];
       const reader = new FileReader();
       
       reader.onload = function(e) {
           $('#imagePreview').attr('src', e.target.result).show();
       }
       
       if (file) {
           reader.readAsDataURL(file);
       } else {
           $('#imagePreview').hide();
       }
   });
});
</script>
@endsection
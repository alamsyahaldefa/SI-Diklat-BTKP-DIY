@extends('layouts/contentNavbarLayout')

@section('title', 'Cards basic   - UI elements')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3"><span class="text-muted fw-light">Administrator /</span> Foto Diklat</h4>

<!-- Examples -->
<!-- <div class="row mb-5">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <a href="javascript:void(0)" class="btn btn-outline-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
      </div>
      <img class="img-fluid" src="{{asset('assets/img/elements/13.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
        <a href="javascript:void(0);" class="card-link">Card link</a>
        <a href="javascript:void(0);" class="card-link">Another link</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
        <img class="img-fluid d-flex mx-auto my-4 rounded" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
        <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
        <a href="javascript:void(0);" class="card-link">Card link</a>
        <a href="javascript:void(0);" class="card-link">Another link</a>
      </div>
    </div>
  </div>
</div> -->
<!-- Examples -->

<!-- Content types -->
<!-- <h5 class="pb-1 mb-4">Content types</h5>

<div class="row mb-5">
  <div class="col-md-6 col-lg-4">
    <h6 class="mt-2 text-muted">Body</h6>
    <div class="card mb-4">
      <div class="card-body">
        <p class="card-text">
          This is some text within a card body.
          Jelly lemon drops tiramisu chocolate cake cotton candy soufflé oat cake sweet roll. Sugar plum marzipan dragée
          topping cheesecake chocolate bar. Danish muffin icing donut.
        </p>
      </div>
    </div>
    <h6 class="mt-2 text-muted">Titles, text, and links</h6>
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <div class="card-subtitle text-muted mb-3">Card subtitle</div>
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <a href="javascript:void(0)" class="card-link">Card link</a>
        <a href="javascript:void(0)" class="card-link">Another link</a>
      </div>
    </div>
    <h6 class="mt-2 text-muted">List groups</h6>
    <div class="card mb-4">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <h6 class="mt-2 text-muted">Images</h6>
    <div class="card mb-4">
      <img class="card-img-top" src="{{asset('assets/img/elements/5.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <p class="card-text">Cookie topping caramels jujubes gingerbread. Lollipop apple pie cupcake candy canes cookie
          ice cream. Wafer chocolate bar carrot cake jelly-o.</p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <h6 class="mt-2 text-muted">Kitchen sink</h6>
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/7.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title.
        </p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
      <div class="card-body">
        <a href="javascript:void(0)" class="card-link">Card link</a>
        <a href="javascript:void(0)" class="card-link">Another link</a>
      </div>
    </div>
  </div>
</div>

<h6 class="pb-1 mb-4 text-muted">Header and footer</h6>
<div class="row mb-5">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">
          With supporting text below as a natural lead-in to additional content natural lead-in to additional content.
        </p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card">
      <h5 class="card-header">Quote</h5>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.Lorem ipsum dolor sit
            amet,
            consectetur.
          </p>
          <footer class="blockquote-footer">
            Someone famous in
            <cite title="Source Title">Source Title</cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
      <div class="card-footer text-muted">
        2 days ago
      </div>
    </div>
  </div>
</div> -->
<!--/ Content types -->

<!-- Text alignment -->
<!-- <h5 class="pb-1 mb-4">Text alignment</h5>
<div class="row mb-5">
  <div class="col-md-6 col-lg-4">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card text-center mb-3">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card text-end mb-3">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div> -->
<!--/ Text alignment -->

<!-- Images -->
<!-- <h5 class="pb-1 mb-4">Images caps & overlay</h5>
<div class="row mb-5">
  <div class="col-md-6 col-xl-4">
    <div class="card mb-3">
      <img class="card-img-top" src="{{asset('assets/img/elements/18.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
          little bit longer.
        </p>
        <p class="card-text">
          <small class="text-muted">Last updated 3 mins ago</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
          little bit longer.
        </p>
        <p class="card-text">
          <small class="text-muted">Last updated 3 mins ago</small>
        </p>
      </div>
      <img class="card-img-bottom" src="{{asset('assets/img/elements/1.jpg')}}" alt="Card image cap" />
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-dark border-0 text-white">
      <img class="card-img" src="{{asset('assets/img/elements/11.jpg')}}" alt="Card image" />
      <div class="card-img-overlay">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
          little bit longer.
        </p>
        <p class="card-text">Last updated 3 mins ago</p>
      </div>
    </div>
  </div>
</div> -->
<!--/ Images -->

<!-- Horizontal -->
<!-- <h5 class="pb-1 mb-4">Horizontal</h5>
<div class="row mb-5">
  <div class="col-md">
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img class="card-img card-img-left" src="{{asset('assets/img/elements/12.jpg')}}" alt="Card image" />
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              This is a wider card with supporting text below as a natural lead-in to additional content. This content
              is a
              little bit longer.
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md">
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              This is a wider card with supporting text below as a natural lead-in to additional content. This content
              is a
              little bit longer.
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="col-md-4">
          <img class="card-img card-img-right" src="{{asset('assets/img/elements/17.jpg')}}" alt="Card image" />
        </div>
      </div>
    </div>
  </div>
</div> -->
<!--/ Horizontal -->

<!-- Style variation -->
<!-- <h5 class="pb-1 mb-4">Style variation</h5>
<div class="row">
  <div class="col-md-6 col-xl-4">
    <div class="card bg-primary text-white mb-3">
      <div class="card-header">Header</div>
      <div class="card-body">
        <h5 class="card-title text-white">Primary card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-secondary text-white mb-3">
      <div class="card-header">Header</div>
      <div class="card-body">
        <h5 class="card-title text-white">Secondary card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-success text-white mb-3">
      <div class="card-header">Header</div>
      <div class="card-body">
        <h5 class="card-title text-white">Success card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-danger text-white mb-3">
      <div class="card-header">Header</div>
      <div class="card-body">
        <h5 class="card-title text-white">Danger card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-warning text-white mb-3">
      <div class="card-header">Header</div>
      <div class="card-body">
        <h5 class="card-title text-white">Warning card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-info text-white mb-3">
      <div class="card-header">Header</div>
      <div class="card-body">
        <h5 class="card-title text-white">Info card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
</div> -->
<!-- Outline -->
<!-- <div class="row">
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-primary mb-3">
      <div class="card-body">
        <h5 class="card-title">Primary card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-secondary mb-3">
      <div class="card-body">
        <h5 class="card-title">Secondary card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-success mb-3">
      <div class="card-body">
        <h5 class="card-title">Success card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-danger mb-3">
      <div class="card-body">
        <h5 class="card-title">Danger card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-warning mb-3">
      <div class="card-body">
        <h5 class="card-title">Warning card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-info mb-3">
      <div class="card-body">
        <h5 class="card-title">Info card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
</div> -->
<!--/ Style variation -->


<!-- Card layout -->
<h5 class="pb-1">Data Dokumentasi Diklat</h5>

<!-- Card Groups -->
<!-- <h6 class="pb-1 mb-4 text-muted">Card Groups</h6>
<div class="card-group mb-5">
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">
        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
        little
        bit longer.
      </p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/5.jpg')}}" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/1.jpg')}}" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">
        This is a wider card with supporting text below as a natural lead-in to additional content. This card has even
        longer
        content than the first to show that equal height action.
      </p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div> -->


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




<!-- Masonry -->
<!-- <h6 class="pb-1 mb-4 text-muted">Masonry</h6>
<div class="row" data-masonry='{"percentPosition": true }'>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/5.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title that wraps to a new line</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card p-3">
      <figure class="p-3 mb-0">
        <blockquote class="blockquote">
          <p>A well-known quote, contained in a blockquote element.</p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0 text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/18.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card bg-primary text-white text-center p-3">
      <figure class="mb-0">
        <blockquote class="blockquote">
          <p>A well-known quote, contained in a blockquote element.</p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0 text-white">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has a regular title and short paragraph of text below it.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card p-3 text-end">
      <figure class="mb-0">
        <blockquote class="blockquote">
          <p>A well-known quote, contained in a blockquote element.</p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0 text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div> -->
<!--/ Card layout -->
@endsection
@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard Administrator -')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">
              Hai, {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->user : 'Admin' }}!
            </h5>
            <p class="mb-4">Selamat Datang di Halaman Administrator.</p>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik -->
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Total Pengguna</h6>
          <p class="card-text display-4 text-primary">+1000</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Jumlah Diklat</h6>
          <p class="card-text display-4 text-success">+50</p>
        </div>
      </div>
    </div>
  </div>
@endsection
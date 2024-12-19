@extends('layouts/blankLayout')

@section('title', 'Login Administrator')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
<!-- Logo -->
<div class="app-brand justify-content-center bg-color-white">
    <a href="{{ url('/') }}" class="app-brand-link gap-2">
      <img src="{{ asset('assets/img/branding/logo-btkp.png') }}" alt="Logo BTKP" style="width:150px; height:auto;">
    </a>
</div>

          <!-- /Logo -->
          <h4 class="mb-4">Login Administrator</h4>

          <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
            <div class="mb-3">
              <label for="email" class="form-label">Username</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="Masukkan Username" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <!-- <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Forgot Password?</small>
                </a> -->
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Password" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <a href="{{ route('dashboard') }}" class="btn btn-primary d-grid w-100">LOGIN</a>
            </div>
          </form>

        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
  <p class="text-center">
    <span>Copyrights | 2024  Balai Tekkomdik DIY</span>
  </p>
</div>
</div>
@endsection

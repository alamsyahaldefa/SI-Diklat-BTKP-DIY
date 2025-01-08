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
          <h4 class="mb-4">Login Administrator</h4>
          <!-- Alert jika login gagal -->
          @if ($errors->has('login_error'))
          <div class="alert alert-danger">
            {{ $errors->first('login_error') }}
          </div>
          @endif


          <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="user" class="form-label">Username</label>
              <input type="text" class="form-control" id="user" name="username" placeholder="Masukkan Username" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Password" autofocus>
                <span class="input-group-text cursor-pointer"></span>
              </div>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary d-grid w-100">LOGIN</button>
            </div>
            <div class="text-center">
              <p class="mb-0">
                <a href="{{ route('auth-register-administrator') }}" class="text-primary text-decoration-none fw-normal"
                  onmouseover="this.classList.add('fw-bold')"
                  onmouseout="this.classList.remove('fw-bold')">
                  Create Account
                </a>
                |
                <a href="{{ route('auth-reset-password-admin') }}" class="text-muted text-decoration-none fw-normal"
                  onmouseover="this.classList.add('fw-bold')"
                  onmouseout="this.classList.remove('fw-bold')">
                  Forgot Password?
                </a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <p class="text-center">
    <span>Copyrights | 2025 Balai Tekkomdik DIY</span>
  </p>
</div>
</div>
@endsection
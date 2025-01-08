@extends('layouts/blankLayout')

@section('title', 'Register Admin - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Create New Account</h4>
          <p class="mb-4">Make your app management easy!</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('auth.register-admin') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter your username" autofocus>
              @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"></span>
              </div>
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" onchange="toggleSignUpButton()">
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
              </div>
              @error('terms')
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
            <button id="sign-up-button" type="submit" class="btn btn-primary d-grid w-100" disabled>
              Sign up
            </button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('auth-login') }}" class="text-primary text-decoration-none fw-normal"
              onmouseover="this.classList.add('fw-bold')"
              onmouseout="this.classList.remove('fw-bold')">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleSignUpButton() {
    const checkbox = document.getElementById('terms-conditions');
    const signUpButton = document.getElementById('sign-up-button');
    signUpButton.disabled = !checkbox.checked;
  }
</script>

@endsection
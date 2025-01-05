@php
$dashboard_url = Auth::check() ? route('dashboard') : url('/dashboard');
@endphp

<style>
    .text-custom {
        color: #343a40 !important;
    }
</style>

<div class="app-brand justify-content-center p-4 d-flex align-items-center">
    <a href="{{ $dashboard_url }}" class="app-brand-link d-flex align-items-center">
        <img src="{{ asset('assets/img/branding/logo-btkp2.png') }}" alt="Logo BTKP" style="width: 28px; height:auto; margin-right: 15px;">
        <span class="app-brand-text text-body fw-bold fs-4 text-custom">Administrator</span>
    </a>
</div>
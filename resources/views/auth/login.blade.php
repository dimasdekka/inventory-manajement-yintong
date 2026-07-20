@extends('layouts.auth')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <i class="fa-solid fa-boxes-stacked"></i>
        <span>Yintong Inventory</span>
    </div>
    <div class="auth-subtitle">Sistem Informasi Inventori & Aset Tetap</div>

    <!-- Alert error jika ada error validasi atau dari session -->
    @if ($errors->any())
        <div class="alert-custom">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Alert sukses jika logout -->
    @if (session('success'))
        <div class="alert-success-custom">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@instansi.com" required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Kata Sandi</label>
            <div class="input-group">
                <input type="password" class="form-control form-control-has-group" id="password" name="password" placeholder="••••••••" required>
                <span class="input-group-text input-group-text-custom" id="togglePassword">
                    <i class="fa-regular fa-eye" id="eyeIcon"></i>
                </span>
            </div>
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" style="cursor: pointer;">
                <label class="form-check-label text-muted" for="remember" style="font-size: 13px; cursor: pointer; user-select: none;">Ingat saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom">
            Masuk <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
        </button>
    </form>

    <div class="copyright">
        &copy; {{ date('Y') }} Sistem Informasi Inventori
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fa-regular fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fa-regular fa-eye';
            }
        });
    });
</script>
@endsection

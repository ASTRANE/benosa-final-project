@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #E8F5E9 0%, #fff 100%);">
    <div class="w-100 px-3">
        <div class="card auth-card mx-auto p-4">
            <div class="text-center mb-4">
                <div class="auth-logo mb-2"><i class="bi bi-heart-pulse-fill"></i></div>
                <h4 class="fw-bold" style="color:#2E7D32;">BenoCare</h4>
                <p class="text-muted small">Sign in to your account</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="doctor@hospital.com" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                </button>
            </form>

            <p class="text-center mt-3 small text-muted">
                Don't have an account? <a href="{{ route('register') }}" style="color:#2E7D32;">Register</a>
            </p>
        </div>
    </div>
</div>
@endsection

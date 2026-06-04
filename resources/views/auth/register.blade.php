@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #E8F5E9 0%, #fff 100%);">
    <div class="w-100 px-3">
        <div class="card auth-card mx-auto p-4">
            <div class="text-center mb-4">
                <div class="auth-logo mb-2"><i class="bi bi-heart-pulse-fill"></i></div>
                <h4 class="fw-bold" style="color:#2E7D32;">Create Account</h4>
                <p class="text-muted small">Join the BenoCare system</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Dr. Juan Dela Cruz" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="doctor@hospital.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">Select role...</option>
                        <option value="Doctor" {{ old('role')=='Doctor'?'selected':'' }}>Doctor</option>
                        <option value="Nurse" {{ old('role')=='Nurse'?'selected':'' }}>Nurse</option>
                        <option value="Admin" {{ old('role')=='Admin'?'selected':'' }}>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 8 characters" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-person-plus me-1"></i> Create Account
                </button>
            </form>

            <p class="text-center mt-3 small text-muted">
                Already have an account? <a href="{{ route('login') }}" style="color:#2E7D32;">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection

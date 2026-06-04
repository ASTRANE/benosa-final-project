@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="fw-bold mb-0" style="color:#2E7D32;"><i class="bi bi-person-circle me-1"></i> My Profile</h5>
    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit Profile</a>
</div>

<div class="card stat-card p-4" style="max-width:560px;">
    <div class="d-flex align-items-center gap-4 mb-4 pb-3 border-bottom">
        @if($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle" width="72" height="72" style="object-fit:cover;border:3px solid var(--green-border);">
        @else
            <div style="width:72px;height:72px;border-radius:50%;background:var(--green-pale);color:var(--green);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;border:3px solid var(--green-border);">
                {{ strtoupper(substr($user->name,0,1)) }}
            </div>
        @endif
        <div>
            <h5 class="mb-0 fw-bold">{{ $user->name }}</h5>
            <span class="badge" style="background:var(--green-pale);color:var(--green);">{{ $user->role }}</span>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12">
            <div class="text-muted small">Email Address</div>
            <div class="fw-semibold"><i class="bi bi-envelope me-1" style="color:#2E7D32;"></i>{{ $user->email }}</div>
        </div>
        <div class="col-12">
            <div class="text-muted small">Role</div>
            <div class="fw-semibold"><i class="bi bi-shield-check me-1" style="color:#2E7D32;"></i>{{ $user->role }}</div>
        </div>
        <div class="col-12">
            <div class="text-muted small">Member Since</div>
            <div class="fw-semibold"><i class="bi bi-calendar3 me-1" style="color:#2E7D32;"></i>{{ $user->created_at->format('F d, Y') }}</div>
        </div>
    </div>
</div>
@endsection

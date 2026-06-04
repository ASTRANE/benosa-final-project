@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h5 class="fw-bold mb-0" style="color:#2E7D32;">Edit Profile</h5>
</div>

<div class="card stat-card p-4" style="max-width:560px;">
    @if($errors->any())
    <div class="alert alert-danger py-2 small mb-3">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="text-center mb-4">
            @if($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" class="rounded-circle mb-2" width="80" height="80" style="object-fit:cover;border:3px solid var(--green-border);">
            @else
                <div class="mx-auto mb-2" style="width:80px;height:80px;border-radius:50%;background:var(--green-pale);color:var(--green);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>
            @endif
            <div>
                <label class="form-label small fw-semibold d-block">Profile Picture</label>
                <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-semibold">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-semibold">Role</label>
            <select name="role" class="form-select" required>
                @foreach(['Doctor','Nurse','Admin'] as $r)
                <option value="{{ $r }}" {{ old('role', $user->role) == $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <p class="small text-muted">Leave password fields blank to keep current password.</p>
        <div class="mb-3">
            <label class="form-label small fw-semibold">New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Min. 8 characters">
        </div>
        <div class="mb-4">
            <label class="form-label small fw-semibold">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i> Save Changes</button>
            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

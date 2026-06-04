@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="fw-bold mb-0" style="color:#2E7D32;"><i class="bi bi-person-gear me-1"></i> User Management</h5>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Add User
    </a>
</div>

{{-- Filters --}}
<div class="card stat-card p-3 mb-3">
    <form method="GET" action="{{ route('users.index') }}" class="row g-2 align-items-end">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name or email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="role" class="form-select form-select-sm">
                <option value="">All Roles</option>
                @foreach(['Doctor','Nurse','Admin'] as $r)
                <option value="{{ $r }}" {{ request('role') == $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-search me-1"></i>Search</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
        </div>
    </form>
</div>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-muted small">{{ $user->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" class="rounded-circle" width="32" height="32" style="object-fit:cover;">
                            @else
                                <div style="width:32px;height:32px;border-radius:50%;background:var(--green-pale);color:var(--green);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;">
                                    {{ strtoupper(substr($user->name,0,1)) }}
                                </div>
                            @endif
                            <span class="fw-semibold">{{ $user->name }}
                                @if($user->id === Auth::id())
                                    <span class="badge ms-1" style="background:var(--green-pale);color:var(--green);font-size:.7rem;">You</span>
                                @endif
                            </span>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $user->email }}</td>
                    <td>
                        @php
                            $roleColors = ['Doctor'=>'#1565C0','Nurse'=>'#6A1B9A','Admin'=>'#E65100'];
                            $roleBg = ['Doctor'=>'#E3F2FD','Nurse'=>'#F3E5F5','Admin'=>'#FFF3E0'];
                        @endphp
                        <span class="badge rounded-pill" style="background:{{ $roleBg[$user->role] ?? '#eee' }};color:{{ $roleColors[$user->role] ?? '#333' }};">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                            @if($user->id !== Auth::id())
                            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete user {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i> No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-3 border-top">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection

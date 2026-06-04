@extends('layouts.app')

@section('title', 'Add User')
@section('page-title', 'Add User')

@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h5 class="fw-bold mb-0" style="color:#2E7D32;">Add New User</h5>
</div>

<div class="card stat-card p-4" style="max-width:520px;">
    @if($errors->any())
    <div class="alert alert-danger py-2 small mb-3">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        @include('users._form', ['user' => null])
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i> Create User</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

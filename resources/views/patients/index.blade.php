@extends('layouts.app')

@section('title', 'Patients')
@section('page-title', 'Patient Records')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="fw-bold mb-0" style="color:#2E7D32;"><i class="bi bi-people me-1"></i> Patient Records</h5>
    <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Add Patient
    </a>
</div>

{{-- Filters --}}
<div class="card stat-card p-3 mb-3">
    <form method="GET" action="{{ route('patients.index') }}" class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name, condition, contact..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select form-select-sm">
                <option value="">All Status</option>
                <option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option>
                <option value="Archived" {{ request('status')=='Archived'?'selected':'' }}>Archived</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="gender" class="form-select form-select-sm">
                <option value="">All Gender</option>
                <option value="Male" {{ request('gender')=='Male'?'selected':'' }}>Male</option>
                <option value="Female" {{ request('gender')=='Female'?'selected':'' }}>Female</option>
                <option value="Other" {{ request('gender')=='Other'?'selected':'' }}>Other</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-search me-1"></i>Search</button>
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
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
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Condition</th>
                    <th>Date of Visit</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td class="text-muted small">{{ $patient->id }}</td>
                    <td class="fw-semibold">{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->medical_condition }}</td>
                    <td>{{ $patient->date_of_visit->format('M d, Y') }}</td>
                    <td>
                        <span class="badge rounded-pill {{ $patient->status === 'Active' ? 'badge-active' : 'badge-archived' }}">
                            {{ $patient->status }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('patients.show', $patient) }}" class="btn btn-outline-primary btn-sm" title="View"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('patients.destroy', $patient) }}" onsubmit="return confirm('Delete this patient record?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i> No patient records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($patients->hasPages())
    <div class="p-3 border-top">
        {{ $patients->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection

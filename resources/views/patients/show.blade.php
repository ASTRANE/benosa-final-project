@extends('layouts.app')

@section('title', $patient->name)
@section('page-title', 'Patient Details')

@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h5 class="fw-bold mb-0" style="color:#2E7D32;">Patient Record</h5>
    <div class="ms-auto d-flex gap-2">
        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i>Edit</a>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="bi bi-printer me-1"></i>Print</button>
    </div>
</div>

<div class="card stat-card p-4" style="max-width:720px;" id="printable">
    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
        <div style="width:56px;height:56px;border-radius:50%;background:var(--green-pale);color:var(--green);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;">
            {{ strtoupper(substr($patient->name,0,1)) }}
        </div>
        <div>
            <h5 class="mb-0 fw-bold">{{ $patient->name }}</h5>
            <span class="badge rounded-pill {{ $patient->status === 'Active' ? 'badge-active' : 'badge-archived' }}">{{ $patient->status }}</span>
        </div>
    </div>

    <div class="row g-3">
        @php
        $fields = [
            ['Age', $patient->age . ' years old', 'bi-person'],
            ['Gender', $patient->gender, 'bi-gender-ambiguous'],
            ['Contact Number', $patient->contact_number, 'bi-telephone'],
            ['Date of Visit', $patient->date_of_visit->format('F d, Y'), 'bi-calendar3'],
            ['Medical Condition', $patient->medical_condition, 'bi-clipboard2-pulse'],
            ['Address', $patient->address, 'bi-geo-alt'],
        ];
        @endphp
        @foreach($fields as [$label, $value, $icon])
        <div class="col-md-6">
            <div class="d-flex gap-2 align-items-start">
                <i class="bi {{ $icon }} mt-1" style="color:#2E7D32;"></i>
                <div>
                    <div class="text-muted small">{{ $label }}</div>
                    <div class="fw-semibold">{{ $value }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
@media print {
    #sidebar, #topbar, .btn, .d-flex.align-items-center.gap-2.mb-3 { display: none !important; }
    #main { margin-left: 0 !important; }
    #printable { box-shadow: none !important; }
}
</style>
@endpush
@endsection

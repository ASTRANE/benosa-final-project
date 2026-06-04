@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="text-muted small">Total Patients</div>
                    <div class="fw-bold fs-4">{{ $total }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box"><i class="bi bi-person-plus-fill"></i></div>
                <div>
                    <div class="text-muted small">New This Month</div>
                    <div class="fw-bold fs-4">{{ $newThisMonth }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box"><i class="bi bi-activity"></i></div>
                <div>
                    <div class="text-muted small">Active Cases</div>
                    <div class="fw-bold fs-4">{{ $active }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box"><i class="bi bi-archive-fill"></i></div>
                <div>
                    <div class="text-muted small">Archived</div>
                    <div class="fw-bold fs-4">{{ $archived }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="card stat-card p-3">
            <h6 class="fw-semibold mb-3" style="color:#2E7D32;"><i class="bi bi-bar-chart-line me-1"></i> Monthly Patient Visits ({{ now()->year }})</h6>
            <canvas id="monthlyChart" height="100"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-3 mb-3">
            <h6 class="fw-semibold mb-3" style="color:#2E7D32;"><i class="bi bi-gender-ambiguous me-1"></i> Gender Distribution</h6>
            <canvas id="genderChart" height="160"></canvas>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card stat-card p-3">
            <h6 class="fw-semibold mb-3" style="color:#2E7D32;"><i class="bi bi-clipboard2-pulse me-1"></i> Top Medical Conditions</h6>
            <canvas id="conditionsChart" height="60"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
const green = '#2E7D32', greenLight = '#43A047', greenPale = '#E8F5E9';
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Visits',
            data: @json($monthlyData),
            backgroundColor: greenPale,
            borderColor: green,
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

const genderData = @json($genderData);
new Chart(document.getElementById('genderChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(genderData),
        datasets: [{
            data: Object.values(genderData),
            backgroundColor: ['#2E7D32','#81C784','#C8E6C9'],
            borderWidth: 0,
        }]
    },
    options: { plugins: { legend: { position: 'bottom' } }, cutout: '65%' }
});

const condData = @json($conditions);
new Chart(document.getElementById('conditionsChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(condData),
        datasets: [{
            label: 'Patients',
            data: Object.values(condData),
            backgroundColor: green,
            borderRadius: 6,
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});
</script>
@endpush

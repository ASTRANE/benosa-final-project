<!DOCTYPE html>
@php use Illuminate\Support\Facades\Storage; @endphp
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RiteMed') — RiteMed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --green: #2E7D32;
            --green-light: #43A047;
            --green-pale: #E8F5E9;
            --green-border: #C8E6C9;
        }
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        #sidebar {
            width: 240px; min-height: 100vh; background: #fff;
            border-right: 1px solid var(--green-border);
            position: fixed; top: 0; left: 0; z-index: 100;
            transition: transform .25s ease;
        }
        #sidebar .brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--green-border);
            color: var(--green); font-weight: 700; font-size: 1.2rem;
        }
        #sidebar .brand i { margin-right: .4rem; }
        #sidebar .nav-link {
            color: #555; padding: .65rem 1.5rem; border-radius: 0;
            display: flex; align-items: center; gap: .6rem;
            transition: background .15s, color .15s;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background: var(--green-pale); color: var(--green); font-weight: 600;
        }
        #sidebar .nav-link.active { border-left: 3px solid var(--green); }

        /* Main content */
        #main { margin-left: 240px; min-height: 100vh; }
        #topbar {
            background: #fff; border-bottom: 1px solid var(--green-border);
            padding: .75rem 1.5rem; position: sticky; top: 0; z-index: 99;
        }

        /* Cards */
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .stat-card .icon-box {
            width: 48px; height: 48px; border-radius: 10px;
            background: var(--green-pale); color: var(--green);
            display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
        }

        /* Buttons */
        .btn-primary { background: var(--green); border-color: var(--green); }
        .btn-primary:hover { background: var(--green-light); border-color: var(--green-light); }
        .btn-outline-primary { color: var(--green); border-color: var(--green); }
        .btn-outline-primary:hover { background: var(--green); border-color: var(--green); }

        /* Table */
        .table thead th { background: var(--green-pale); color: var(--green); font-weight: 600; border: none; }
        .table tbody tr:hover { background: #fafffe; }

        /* Badge */
        .badge-active { background: var(--green-pale); color: var(--green); }
        .badge-archived { background: #f5f5f5; color: #757575; }

        /* Form focus */
        .form-control:focus, .form-select:focus {
            border-color: var(--green); box-shadow: 0 0 0 .2rem rgba(46,125,50,.15);
        }

        /* Toast container */
        #toast-container { position: fixed; top: 1.2rem; right: 1.2rem; z-index: 9999; min-width: 280px; }

        /* Auth pages */
        .auth-card { max-width: 440px; border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .auth-logo { color: var(--green); font-size: 2rem; }

        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

@auth
<div id="sidebar">
    <div class="brand"><i class="bi bi-heart-pulse-fill"></i> RiteMed</div>
    <nav class="nav flex-column pt-2">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Patients
        </a>
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-person-gear"></i> Users
        </a>
        <a href="{{ route('profile.show') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profile
        </a>
        <hr class="mx-3 my-2">
        <a href="{{ route('logout') }}" class="nav-link text-danger">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </nav>
</div>

<div id="main">
    <div id="topbar" class="d-flex align-items-center justify-content-between">
        <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="bi bi-list"></i>
        </button>
        <span class="text-muted small">@yield('page-title', 'Dashboard')</span>
        <div class="d-flex align-items-center gap-2">
            @if(Auth::user()->avatar)
                <img src="{{ Storage::url(Auth::user()->avatar) }}" class="rounded-circle" width="32" height="32" style="object-fit:cover">
            @else
                <div style="width:32px;height:32px;border-radius:50%;background:var(--green-pale);color:var(--green);display:flex;align-items:center;justify-content:center;font-weight:700;">
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                </div>
            @endif
            <span class="small fw-semibold">{{ Auth::user()->name }}</span>
            <span class="badge" style="background:var(--green-pale);color:var(--green);">{{ Auth::user()->role }}</span>
        </div>
    </div>

    <div class="p-4">
        @yield('content')
    </div>
</div>
@else
    @yield('content')
@endauth

{{-- Toast Notifications --}}
<div id="toast-container">
    @if(session('success'))
    <div class="toast align-items-center text-white border-0 show mb-2" role="alert" style="background:var(--green);">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="toast align-items-center text-white border-0 show mb-2" role="alert" style="background:#c62828;">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss toasts after 4s
    document.querySelectorAll('.toast').forEach(el => {
        setTimeout(() => new bootstrap.Toast(el, {delay:4000}).hide(), 100);
    });
</script>
@stack('scripts')
</body>
</html>

<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total      = Patient::count();
        $active     = Patient::where('status', 'Active')->count();
        $archived   = Patient::where('status', 'Archived')->count();
        $newThisMonth = Patient::whereYear('created_at', now()->year)
                               ->whereMonth('created_at', now()->month)
                               ->count();

        // Monthly visits for current year (chart data)
        $monthly = Patient::selectRaw("MONTH(date_of_visit) as month, COUNT(*) as count")
            ->whereYear('date_of_visit', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthly[$i] ?? 0;
        }

        // Gender distribution
        $genderData = Patient::selectRaw('gender, COUNT(*) as count')
            ->groupBy('gender')
            ->pluck('count', 'gender');

        // Top conditions
        $conditions = Patient::selectRaw('medical_condition, COUNT(*) as count')
            ->groupBy('medical_condition')
            ->orderByDesc('count')
            ->limit(5)
            ->pluck('count', 'medical_condition');

        return view('dashboard', compact(
            'total', 'active', 'archived', 'newThisMonth',
            'monthlyData', 'genderData', 'conditions'
        ));
    }
}

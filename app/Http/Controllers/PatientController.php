<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('medical_condition', 'like', "%$s%")
                  ->orWhere('contact_number', 'like', "%$s%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $patients = $query->latest()->paginate(10)->withQueryString();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'age'               => 'required|integer|min:0|max:150',
            'gender'            => 'required|in:Male,Female,Other',
            'address'           => 'required|string',
            'contact_number'    => 'required|string|max:20',
            'medical_condition' => 'required|string|max:255',
            'date_of_visit'     => 'required|date',
            'status'            => 'required|in:Active,Archived',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient record added successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'age'               => 'required|integer|min:0|max:150',
            'gender'            => 'required|in:Male,Female,Other',
            'address'           => 'required|string',
            'contact_number'    => 'required|string|max:20',
            'medical_condition' => 'required|string|max:255',
            'date_of_visit'     => 'required|date',
            'status'            => 'required|in:Active,Archived',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient record updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient record deleted successfully.');
    }
}

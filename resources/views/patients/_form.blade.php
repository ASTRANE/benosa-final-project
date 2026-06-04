<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label small fw-semibold">Patient Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label small fw-semibold">Age</label>
        <input type="number" name="age" class="form-control" value="{{ old('age', $patient->age ?? '') }}" min="0" max="150" required>
    </div>
    <div class="col-md-3">
        <label class="form-label small fw-semibold">Gender</label>
        <select name="gender" class="form-select" required>
            <option value="">Select...</option>
            @foreach(['Male','Female','Other'] as $g)
            <option value="{{ $g }}" {{ old('gender', $patient->gender ?? '') == $g ? 'selected' : '' }}>{{ $g }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12">
        <label class="form-label small fw-semibold">Address</label>
        <textarea name="address" class="form-control" rows="2" required>{{ old('address', $patient->address ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label small fw-semibold">Contact Number</label>
        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $patient->contact_number ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label small fw-semibold">Medical Condition</label>
        <input type="text" name="medical_condition" class="form-control" value="{{ old('medical_condition', $patient->medical_condition ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label small fw-semibold">Date of Visit</label>
        <input type="date" name="date_of_visit" class="form-control" value="{{ old('date_of_visit', isset($patient) ? $patient->date_of_visit->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label small fw-semibold">Status</label>
        <select name="status" class="form-select" required>
            @foreach(['Active','Archived'] as $s)
            <option value="{{ $s }}" {{ old('status', $patient->status ?? 'Active') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
    </div>
</div>

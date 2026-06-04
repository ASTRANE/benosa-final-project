<div class="mb-3">
    <label class="form-label small fw-semibold">Full Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label small fw-semibold">Email Address</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label small fw-semibold">Role</label>
    <select name="role" class="form-select" required>
        <option value="">Select role...</option>
        @foreach(['Doctor','Nurse','Admin'] as $r)
        <option value="{{ $r }}" {{ old('role', $user->role ?? '') == $r ? 'selected' : '' }}>{{ $r }}</option>
        @endforeach
    </select>
</div>
<hr>
@if($user)
<p class="small text-muted">Leave password fields blank to keep current password.</p>
@endif
<div class="mb-3">
    <label class="form-label small fw-semibold">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Min. 8 characters" {{ $user ? '' : 'required' }}>
</div>
<div class="mb-3">
    <label class="form-label small fw-semibold">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" {{ $user ? '' : 'required' }}>
</div>

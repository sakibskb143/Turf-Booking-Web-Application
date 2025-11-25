@extends('layouts.owner_dashboard_layout')

@section('content')

<style>
    .setting-tab-btn {
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
    }

    .setting-tab-btn.active {
        background: white;
        border-bottom: 2px solid black;
    }

    .form-label {
        font-weight: 600;
    }

    .input-group-text {
        background: #f3f4f6;
        border-right: none;
    }

    .delete-box {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        border-radius: 8px;
        padding: 16px;
    }
</style>

<h2 class="fw-bold mb-1">Profile Settings</h2>
<p class="text-muted mb-4">Manage your account information and preferences.</p>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<!-- Tabs -->
<div class="d-flex gap-2 mb-4">
    <button class="setting-tab-btn active" id="tabProfileBtn" onclick="switchTab('profile')">
        Profile Information
    </button>

    <button class="setting-tab-btn" id="tabSecurityBtn" onclick="switchTab('security')">
        Security Settings
    </button>
</div>

<!-- PROFILE INFORMATION TAB -->
<div id="profileTab" class="tab-section">
    <div class="card p-4 shadow-sm mb-4">
        <h5 class="fw-bold mb-1">Profile Information</h5>
        <p class="text-muted">Update your personal information and contact details.</p>

        <form method="POST" action="{{ route('owner.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $owner->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $owner->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $owner->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $owner->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-dark mt-4 px-4">Update Profile</button>
        </form>
    </div>
</div>

<!-- SECURITY SETTINGS TAB -->
<div id="securityTab" class="tab-section d-none">
    <div class="card p-4 shadow-sm mb-4">
        <h5 class="fw-bold mb-1">Security Settings</h5>
        <p class="text-muted">Manage your password and account security.</p>

        <div class="p-3 bg-light border rounded mb-3">
            <p class="fw-semibold mb-1">Password Requirements:</p>
            <ul class="small text-muted mb-0">
                <li>At least 8 characters long</li>
                <li>At least one uppercase letter</li>
                <li>At least one number</li>
                <li>At least one special character</li>
            </ul>
        </div>
        <p class="text-muted">Password change functionality coming soon.</p>
    </div>
</div>

<script>
    function switchTab(tab) {
        const profileTab = document.getElementById('profileTab');
        const securityTab = document.getElementById('securityTab');

        const btnProfile = document.getElementById('tabProfileBtn');
        const btnSecurity = document.getElementById('tabSecurityBtn');

        if (tab === 'profile') {
            profileTab.classList.remove('d-none');
            securityTab.classList.add('d-none');
            btnProfile.classList.add('active');
            btnSecurity.classList.remove('active');
        } else {
            securityTab.classList.remove('d-none');
            profileTab.classList.add('d-none');
            btnSecurity.classList.add('active');
            btnProfile.classList.remove('active');
        }
    }
</script>

@endsection


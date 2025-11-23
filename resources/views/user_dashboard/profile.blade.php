@extends('layouts.user_dashboard_layout')

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

<!-- Tabs (Same design as screenshot) -->
<div class="d-flex gap-2 mb-4">
    <button class="setting-tab-btn active" id="tabProfileBtn" onclick="switchTab('profile')">
        Profile Information
    </button>

    <button class="setting-tab-btn" id="tabSecurityBtn" onclick="switchTab('security')">
        Security Settings
    </button>
</div>

<!-- ================================
     PROFILE INFORMATION (TAB 1)
================================ -->
<div id="profileTab" class="tab-section">

    <div class="card p-4 shadow-sm mb-4">

        <h5 class="fw-bold mb-1">Profile Information</h5>
        <p class="text-muted">Update your personal information and contact details.</p>

        <!-- Profile Image -->
        <div class="mb-4">
            <button class="btn btn-outline-dark btn-sm">
                <i class="bi bi-upload me-2"></i> Change Photo
            </button>
            <p class="small text-muted mt-1">JPG, GIF or PNG. Max size of 2MB.</p>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input class="form-control" value="John Doe">
            </div>

            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input class="form-control" value="john.doe@example.com" disabled>
                <small class="text-muted">Email cannot be changed. Contact support if needed.</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input class="form-control" value="+91 9876543210">
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label">Address</label>
                <textarea class="form-control" rows="2">123 Sports Street, Green Valley, Mumbai - 400001</textarea>
            </div>

            <div class="col-md-12">
                <label class="form-label">Bio</label>
                <textarea class="form-control" rows="3">Passionate football player who loves weekend games with friends.</textarea>
            </div>

        </div>

        <button class="btn btn-dark mt-4 px-4 w-25">Edit Profile</button>


    </div>

</div>

<!-- ================================
     SECURITY SETTINGS (TAB 2)
================================ -->
<div id="securityTab" class="tab-section d-none">

    <div class="card p-4 shadow-sm mb-4">

        <h5 class="fw-bold mb-1">Security Settings</h5>
        <p class="text-muted">Manage your password and account security.</p>

        <label class="form-label">Current Password</label>
        <input type="password" class="form-control mb-3">

        <label class="form-label">New Password</label>
        <input type="password" class="form-control mb-3">

        <label class="form-label">Confirm New Password</label>
        <input type="password" class="form-control mb-3">

        <!-- Password Requirements Box (same design as screenshot) -->
        <div class="p-3 bg-light border rounded mb-3">
            <p class="fw-semibold mb-1">Password Requirements:</p>
            <ul class="small text-muted mb-0">
                <li>At least 8 characters long</li>
                <li>At least one uppercase letter</li>
                <li>At least one number</li>
                <li>At least one special character</li>
            </ul>
        </div>
        <div>
<button class="btn btn-dark px-4 w-25">Change Password</button>
        <button class="btn btn-outline-secondary ms-2 px-4  w-25">Cancel</button>
        </div>
        

    </div>

    <!-- Account Actions -->
    <div class="card p-4 shadow-sm">

        <h5 class="fw-bold mb-1">Account Actions</h5>
        <p class="text-muted">Manage your account settings and data.</p>

        
        <!-- Delete Account (same red box as screenshot) -->
        <div class="delete-box mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="fw-semibold text-danger mb-0">Delete Account</p>
                    <p class="small text-muted mb-0">Permanently deletes your account and all associated data.</p>
                </div>
                <button class="btn btn-danger">Delete Account</button>
            </div>
        </div>

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

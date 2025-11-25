@extends('layouts.owner_dashboard_layout')

@section('content')
<style>
    .status-active { background:#d4f7df; color:#2e8b57; padding:4px 12px; border-radius:6px; font-size:12px; font-weight:600; }
    .status-inactive { background:#fee2e2; color:#991b1b; padding:4px 12px; border-radius:6px; font-size:12px; font-weight:600; }
    .turf-card { border:1px solid #e5e7eb; border-radius:10px; padding:20px; background:white; transition: all 0.3s; }
    .turf-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); transform: translateY(-2px); }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Turf Management</h3>
            <p class="text-muted mb-0">Manage your turfs and their details.</p>
        </div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTurfModal">
            <i class="bi bi-plus-lg me-1"></i> Add New Turf
        </button>
    </div>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Turfs Grid --}}
    <div class="row g-4">
        @forelse($turfs ?? [] as $turf)
            <div class="col-md-6 col-lg-4">
                <div class="turf-card shadow-sm">
                    @if($turf->image_url)
                        <img src="{{ $turf->image_url }}" alt="{{ $turf->name }}" class="img-fluid rounded mb-3" style="height: 150px; width: 100%; object-fit: cover;">
                    @else
                        <div class="bg-light rounded mb-3 d-flex align-items-center justify-content-center" style="height: 150px;">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    
                    <h5 class="fw-bold mb-2">{{ $turf->name }}</h5>
                    <div class="mb-2">
                        <span class="badge bg-info me-1">{{ $turf->sport_type }}</span>
                        <span class="status-{{ $turf->status }}">{{ ucfirst($turf->status) }}</span>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-geo-alt"></i> {{ $turf->location }}, {{ $turf->city }}
                    </p>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-currency-rupee"></i> Base Price: ₹{{ number_format($turf->base_price, 2) }}
                    </p>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar-check"></i> {{ $turf->bookings_count ?? 0 }} bookings
                    </p>
                    
                    @if($turf->description)
                        <p class="text-muted small mb-3">{{ Str::limit($turf->description, 100) }}</p>
                    @endif

                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary btn-sm flex-fill" data-bs-toggle="modal" data-bs-target="#editTurfModal{{ $turf->id }}">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <form method="POST" action="{{ route('owner.turfs.destroy', $turf) }}" class="flex-fill" onsubmit="return confirm('Are you sure you want to delete this turf? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Turf Modal -->
            <div class="modal fade" id="editTurfModal{{ $turf->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Turf</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST" action="{{ route('owner.turfs.update', $turf) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Turf Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $turf->name }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Sport Type</label>
                                        <input type="text" name="sport_type" class="form-control" value="{{ $turf->sport_type }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Location</label>
                                        <input type="text" name="location" class="form-control" value="{{ $turf->location }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">City</label>
                                        <input type="text" name="city" class="form-control" value="{{ $turf->city }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Base Price (₹)</label>
                                    <input type="number" name="base_price" class="form-control" value="{{ $turf->base_price }}" min="0" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Image URL (Optional)</label>
                                    <input type="url" name="image_url" class="form-control" value="{{ $turf->image_url }}" placeholder="https://example.com/image.jpg">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Description (Optional)</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $turf->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active" {{ $turf->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $turf->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark">Update Turf</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card p-5 text-center">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">No turfs yet</h5>
                    <p class="text-muted">Get started by adding your first turf!</p>
                    <button class="btn btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#addTurfModal">
                        <i class="bi bi-plus-lg me-1"></i> Add Your First Turf
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Add Turf Modal -->
<div class="modal fade" id="addTurfModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Turf</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('owner.turfs.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Turf Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Green Valley Football Turf" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sport Type</label>
                            <input type="text" name="sport_type" class="form-control" placeholder="e.g. Football, Cricket, Tennis" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g. Green Valley Sports Complex" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" name="city" class="form-control" placeholder="e.g. Mumbai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Base Price (₹)</label>
                        <input type="number" name="base_price" class="form-control" placeholder="e.g. 1200" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image URL (Optional)</label>
                        <input type="url" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of this turf"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark">Create Turf</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

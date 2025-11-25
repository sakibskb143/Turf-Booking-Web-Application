@extends('layouts.owner_dashboard_layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Slot Management</h3>
            <p class="text-muted mb-0">Create and manage time slots for your turfs.</p>
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSlotModal">
            <i class="bi bi-plus-lg me-1"></i> Add Slot
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

    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Total Slots</p>
                <h4 class="fw-bold">{{ $totalSlots ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Available</p>
                <h4 class="fw-bold text-success">{{ $availableSlots ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Booked</p>
                <h4 class="fw-bold text-primary">{{ $bookedSlots ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-3 shadow-sm">
                <p class="mb-1 text-muted">Revenue Today</p>
                <h4 class="fw-bold text-success">₹{{ number_format($todayRevenue ?? 0, 2) }}</h4>
            </div>
        </div>
    </div>

    {{-- Slots Table --}}
    <div class="card shadow-sm p-3">
        <h5 class="fw-bold mb-3">All Slots ({{ $slots->total() }})</h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Turf</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slots ?? [] as $slot)
                        <tr>
                            <td>
                                <strong>{{ $slot->turf->name }}</strong><br>
                                <small class="text-muted">{{ $slot->turf->sport_type }}</small>
                            </td>
                            <td>{{ $slot->date->format('Y-m-d') }}</td>
                            <td>
                                <i class="bi bi-clock me-1"></i>
                                {{ is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time)) }} - 
                                {{ is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time)) }}
                            </td>
                            <td>₹{{ number_format($slot->price, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $slot->status === 'available' ? 'success' : ($slot->status === 'booked' ? 'primary' : 'warning text-dark') }}">
                                    {{ ucfirst($slot->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSlotModal{{ $slot->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" action="{{ route('owner.slots.destroy', $slot) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this slot?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Slot Modal -->
                        <div class="modal fade" id="editSlotModal{{ $slot->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Slot</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('owner.slots.update', $slot) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Turf</label>
                                                <select name="turf_id" class="form-select" disabled>
                                                    <option>{{ $slot->turf->name }}</option>
                                                </select>
                                                <input type="hidden" name="turf_id" value="{{ $slot->turf_id }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Date</label>
                                                <input type="date" name="date" class="form-control" value="{{ $slot->date->format('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-bold">Start Time</label>
                                                    <input type="time" name="start_time" class="form-control" value="{{ is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time)) }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-bold">End Time</label>
                                                    <input type="time" name="end_time" class="form-control" value="{{ is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time)) }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Price (₹)</label>
                                                <input type="number" name="price" class="form-control" value="{{ $slot->price }}" min="0" step="0.01" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="available" {{ $slot->status === 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="booked" {{ $slot->status === 'booked' ? 'selected' : '' }}>Booked</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-dark">Update Slot</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-2">No slots yet. Add your first slot!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($slots->hasPages())
            <div class="mt-3">
                {{ $slots->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Add Slot Modal -->
<div class="modal fade" id="addSlotModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="" id="addSlotForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Turf</label>
                        <select name="turf_id" id="turfSelect" class="form-select" required>
                            <option value="">Choose a turf...</option>
                            @foreach($turfs ?? [] as $turf)
                                <option value="{{ $turf->id }}">{{ $turf->name }} ({{ $turf->sport_type }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Date</label>
                        <input type="date" name="date" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Start Time</label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">End Time</label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Price (₹)</label>
                        <input type="number" name="price" class="form-control" placeholder="e.g. 1200" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark">Create Slot</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const turfSelect = document.getElementById('turfSelect');
    const addSlotForm = document.getElementById('addSlotForm');
    
    turfSelect.addEventListener('change', function() {
        const turfId = this.value;
        if (turfId) {
            addSlotForm.action = `/owner/turfs/${turfId}/slots`;
        }
    });
});
</script>
@endsection

<div class="card turf-card shadow-sm">
    <img src="{{ $turf->image_url ?? 'https://via.placeholder.com/800x300?text=' . urlencode($turf->name) }}" 
         class="turf-image" 
         alt="{{ $turf->name }}">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h3 class="fw-bold mb-2">{{ $turf->name }}</h3>
                <span class="badge bg-success mb-2">{{ strtoupper($turf->sport_type) }}</span>
                <p class="text-muted mb-2">
                    <i class="fas fa-map-marker-alt"></i> {{ $turf->location }}, {{ $turf->city }}
                </p>
                @if($turf->description)
                    <p class="text-muted">{{ $turf->description }}</p>
                @endif
                <p class="fw-bold text-success mb-0">
                    Base Price: ₹{{ number_format($turf->base_price, 2) }} per hour
                </p>
            </div>
        </div>

        <hr>

        <!-- Date Selector -->
        <div class="mb-4">
            <label for="date-select-{{ $turf->id }}" class="form-label fw-bold">Select Date</label>
            <input type="date" 
                   class="form-control w-auto" 
                   id="date-select-{{ $turf->id }}" 
                   value="{{ $selectedDate }}"
                   min="{{ now()->toDateString() }}">
        </div>

        <!-- Available Slots -->
        <div>
            <h5 class="fw-bold mb-3">Available Slots</h5>
            <div id="slots-container-{{ $turf->id }}" class="row g-2">
                @forelse($turf->slots as $slot)
                    @php
                        $isBooked = $slot->bookings->where('status', '!=', 'cancelled')->isNotEmpty();
                        $slotAvailable = !$isBooked && $slot->status === 'available';
                        $startTime = is_string($slot->start_time) ? $slot->start_time : date('H:i', strtotime($slot->start_time));
                        $endTime = is_string($slot->end_time) ? $slot->end_time : date('H:i', strtotime($slot->end_time));
                    @endphp
                    <div class="col-md-3 col-sm-4 col-6">
                        @if($slotAvailable)
                            @auth
                                @if(auth()->user()->role === 'user')
                                    <button class="slot-box w-100" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#bookingModal"
                                            data-slot-id="{{ $slot->id }}"
                                            data-turf-id="{{ $turf->id }}"
                                            data-turf-name="{{ $turf->name }}"
                                            data-turf-location="{{ $turf->location }}, {{ $turf->city }}"
                                            data-slot-time="{{ $startTime }} - {{ $endTime }}"
                                            data-slot-date="{{ $slot->date->format('Y-m-d') }}"
                                            data-slot-price="{{ $slot->price }}">
                                        <div class="fw-bold">{{ $startTime }} - {{ $endTime }}</div>
                                        <div class="text-success small">₹{{ number_format($slot->price, 2) }}</div>
                                    </button>
                                @else
                                    <div class="slot-box booked w-100">
                                        <div class="fw-bold">{{ $startTime }} - {{ $endTime }}</div>
                                        <div class="small">Login as user</div>
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('users.login') }}" class="slot-box w-100 text-decoration-none text-dark">
                                    <div class="fw-bold">{{ $startTime }} - {{ $endTime }}</div>
                                    <div class="text-success small">₹{{ number_format($slot->price, 2) }}</div>
                                    <div class="small text-muted">Login to book</div>
                                </a>
                            @endauth
                        @else
                            <div class="slot-box booked w-100">
                                <div class="fw-bold">{{ $startTime }} - {{ $endTime }}</div>
                                <div class="text-danger small">Booked</div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No slots available for this date. Please select another date.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date-select-{{ $turf->id }}');
    if (dateInput) {
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        const userRole = @json(auth()->check() ? auth()->user()->role : null);
        const loginUrl = @json(route('users.login'));
        const turfName = @json($turf->name);
        const turfLocation = @json($turf->location . ', ' . $turf->city);
        
        dateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            const turfId = {{ $turf->id }};
            const slotsContainer = document.getElementById('slots-container-{{ $turf->id }}');
            
            // Show loading
            slotsContainer.innerHTML = '<div class="col-12 text-center"><div class="spinner-border text-success" role="status"></div></div>';
            
            // Fetch slots for the selected date
            fetch(`/turfs/${turfId}/slots?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    slotsContainer.innerHTML = '';
                    if (data.slots && data.slots.length > 0) {
                        data.slots.forEach(slot => {
                            const slotDiv = document.createElement('div');
                            slotDiv.className = 'col-md-3 col-sm-4 col-6';
                            
                            if (slot.status === 'available' || slot.status === 'booked') {
                                const isBooked = slot.status === 'booked';
                                if (isBooked) {
                                    slotDiv.innerHTML = `
                                        <div class="slot-box booked w-100">
                                            <div class="fw-bold">${slot.start_time} - ${slot.end_time}</div>
                                            <div class="text-danger small">Booked</div>
                                        </div>
                                    `;
                                } else {
                                    if (isAuthenticated && userRole === 'user') {
                                        slotDiv.innerHTML = `
                                            <button class="slot-box w-100" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#bookingModal"
                                                    data-slot-id="${slot.id}"
                                                    data-turf-id="${turfId}"
                                                    data-turf-name="${turfName}"
                                                    data-turf-location="${turfLocation}"
                                                    data-slot-time="${slot.start_time} - ${slot.end_time}"
                                                    data-slot-date="${slot.date}"
                                                    data-slot-price="${slot.price}">
                                                <div class="fw-bold">${slot.start_time} - ${slot.end_time}</div>
                                                <div class="text-success small">₹${parseFloat(slot.price).toFixed(2)}</div>
                                            </button>
                                        `;
                                    } else if (isAuthenticated) {
                                        slotDiv.innerHTML = `
                                            <div class="slot-box booked w-100">
                                                <div class="fw-bold">${slot.start_time} - ${slot.end_time}</div>
                                                <div class="small">Login as user</div>
                                            </div>
                                        `;
                                    } else {
                                        slotDiv.innerHTML = `
                                            <a href="${loginUrl}" class="slot-box w-100 text-decoration-none text-dark">
                                                <div class="fw-bold">${slot.start_time} - ${slot.end_time}</div>
                                                <div class="text-success small">₹${parseFloat(slot.price).toFixed(2)}</div>
                                                <div class="small text-muted">Login to book</div>
                                            </a>
                                        `;
                                    }
                                }
                            }
                            slotsContainer.appendChild(slotDiv);
                        });
                    } else {
                        slotsContainer.innerHTML = '<div class="col-12"><p class="text-muted">No slots available for this date.</p></div>';
                    }
                })
                .catch(error => {
                    slotsContainer.innerHTML = '<div class="col-12"><p class="text-danger">Error loading slots. Please try again.</p></div>';
                });
        });
    }
});
</script>


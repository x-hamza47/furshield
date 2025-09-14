@extends('dashboard.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h3 class="mb-0"><i class="bx bx-plus"></i> Create Appointment</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('appts.store') }}" method="POST">
                        @csrf

                        {{-- Pet --}}
                        <div class="mb-3">
                            <label class="form-label">Pet</label>
                            <select name="pet_id" class="form-select" required>
                                <option value="">Select Pet</option>
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Vet --}}
                        <div class="mb-3">
                            <label class="form-label">Vet</label>
                            <select name="vet_id" class="form-select" id="vet-select" required>
                                <option value="">Select Vet</option>
                                @foreach ($vets as $vet)
                                    <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Slot --}}
                        <div class="mb-3" id="slots-container">
                            <label class="form-label">Available Slots</label>
                            <select name="appt_time" id="slot-select" class="form-select" required>
                                <option value="">Select a vet first</option>
                            </select>
                        </div>

                        {{-- Date --}}
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="appt_date" class="form-control"
                                min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" required>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('appts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">Create Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('vet-select').addEventListener('change', function() {
    const vetId = this.value;
    const slotSelect = document.getElementById('slot-select');
    slotSelect.innerHTML = '<option value="">Loading...</option>';

    if (!vetId) {
        slotSelect.innerHTML = '<option value="">Select a vet first</option>';
        return;
    }

    fetch(`/vet-slots/${vetId}`)
        .then(res => res.json())
        .then(data => {
            slotSelect.innerHTML = '';
            data.forEach(slot => {
                const parts = slot.split(' ');
                const times = parts[1].split('-');
                const option = document.createElement('option');
                option.value = times[0];
                option.textContent = `${parts[0]} ${times[0]} - ${times[1]}`;
                slotSelect.appendChild(option);
            });
        })
        .catch(() => {
            slotSelect.innerHTML = '<option value="">Error loading slots</option>';
        });
});
</script>
@endpush

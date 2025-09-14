@extends('dashboard.main')
@section('title', '- Add Pet')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-header bg-success text-white rounded-top-4">
                        <h3 class="mb-0 text-white">
                            <i class="bx bx-plus-circle me-2"></i> Add Pet
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('pets.store') }}" method="POST">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label class="form-label">Pet Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Species --}}
                            <div class="mb-3">
                                <label class="form-label">Species</label>
                                <input type="text" name="species"
                                    class="form-control @error('species') is-invalid @enderror"
                                    value="{{ old('species') }}" required>
                                @error('species')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Breed --}}
                            <div class="mb-3">
                                <label class="form-label">Breed</label>
                                <input type="text" name="breed"
                                    class="form-control @error('breed') is-invalid @enderror"
                                    value="{{ old('breed') }}">
                                @error('breed')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Age --}}
                            <div class="mb-3">
                                <label class="form-label">Age (years)</label>
                                <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                                    value="{{ old('age') }}" min="0">
                                @error('age')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gender --}}
                            <div class="mb-4">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Add Pet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

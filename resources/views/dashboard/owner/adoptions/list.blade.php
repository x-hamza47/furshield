@extends('dashboard.main')

@push('styles')
    <style>
        .adoption-container {
            padding: 2rem;
        }

        .filter-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 1.5rem;
            margin-bottom: 20px;
        }

        .filter-card input,
        .filter-card select {
            border-radius: 10px;
        }

        .adoption-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .adoption-card {
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .adoption-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .adoption-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1rem;
        }

        .adoption-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .adoption-meta {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }

        .adoption-status {
            font-weight: 700;
            font-size: 1rem;
            color: #28a745;
            margin-bottom: 0.5rem;
        }

        .btn-request {
            border-radius: 50px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            color: #fff;
            background: #2575fc;
            transition: all 0.3s;
        }

        .btn-request:hover {
            background: linear-gradient(135deg, #2575fc, #1a5edb);
            box-shadow: 0 8px 25px rgba(37, 117, 252, 0.3);
        }

        .badge-status {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 0.35rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 50px;
            color: #fff;
        }

        .available {
            background-color: #28a745;
        }

        .adopted {
            background-color: #dc3545;
        }
    </style>
@endpush

@section('content')
    <div class="container adoption-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="bx bx-heart"></i> Pets for Adoption</h2>
            <a href="{{ route('adoption-requests.my') }}" class="btn btn-success">
                <i class="bx bx-list-check me-1"></i> My Requests</a>
        </div>

        <!-- Filters -->
        <div class="filter-card mb-4">
            <form method="GET" action="{{ route('adoptions.index') }}" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search pets..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="species" class="form-control">
                        <option value="">All Species</option>
                        <option value="Dog" {{ request('species') == 'Dog' ? 'selected' : '' }}>Dog</option>
                        <option value="Cat" {{ request('species') == 'Cat' ? 'selected' : '' }}>Cat</option>
                        <option value="Bird" {{ request('species') == 'Bird' ? 'selected' : '' }}>Bird</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="adopted" {{ request('status') == 'adopted' ? 'selected' : '' }}>Adopted</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i> Filter</button>
                    <a href="{{ route('adoptions.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <!-- Adoption Cards -->
        <div class="adoption-grid">
            @forelse($adoptions as $adoption)
                <div class="adoption-card position-relative">
                    <span class="badge-status {{ $adoption->status == 'available' ? 'available' : 'adopted' }}">
                        {{ ucfirst($adoption->status) }}
                    </span>

                    <img src="{{ $adoption->image ? asset('storage/' . $adoption->image) : asset('dashboard/assets/img/avatars/dummy-1.jpeg') }}"
                        alt="{{ $adoption->name }}">

                    <div>
                        <h5 class="adoption-title">{{ $adoption->name }}</h5>
                        <p class="adoption-meta">{{ $adoption->species }} | Shelter:
                            {{ $adoption->shelter->shelter_name ?? '-' }}</p>
                        <p class="adoption-meta">Age: {{ $adoption->age ?? 'N/A' }} | Breed:
                            {{ $adoption->breed ?? 'Unknown' }}</p>
                        <p class="adoption-status">{{ ucfirst($adoption->status) }}</p>

                        @if($adoption->status == 'available')
                            <form action="{{ route('adoption-requests.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="adoption_id" value="{{ $adoption->id }}">
                                <button type="submit" class="btn btn-request mt-2 w-100">
                                    <i class="bx bx-heart"></i> Request Adoption
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary mt-2 w-100" disabled>
                                <i class="bx bx-check-shield"></i> Already Adopted
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No pets available for adoption.</p>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $adoptions->links() }}
        </div>
    </div>
@endsection

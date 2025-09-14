@extends('dashboard.main')

@push('styles')
    <style>
        /* Modern Table */
        .table-modern {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            font-size: 0.95rem;
        }

        .table-modern thead {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: #fff;
        }

        .table-modern th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .table-modern td {
            vertical-align: middle;
            border: none;
            padding: 12px 15px;
        }

        /* Action buttons */
        .btn-action {
            font-size: 0.85rem;
            padding: 0.35rem 0.65rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        /* Filters Card */
        .filter-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .filter-card input,
        .filter-card select {
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
@endpush
@section('title', '- My Pets')
@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bx bxs-dog"></i> Pets</h2>
            <a href="{{ route('pets.create') }}" class="btn btn-success">
                <i class="bx bx-plus"></i> Add Pet
            </a>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <form method="GET" action="{{ route('pets.index') }}" class="row g-3 align-items-center">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by pet name, species, breed, gender, owner..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-search"></i> Search
                    </button>
                    <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-modern align-middle text-center">
                <thead>
                    <tr>
                        <th class="text-white">#</th>
                        <th class="text-white">Pet Name</th>
                        <th class="text-white">Species</th>
                        <th class="text-white">Breed</th>
                        <th class="text-white">Gender</th>
                        <th class="text-white">Age</th>
                        <th class="text-white">Owner</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $pet)
                        <tr>
                            <td>{{ $pets->firstItem() + $loop->index }}</td>
                            <td>{{ $pet->name }}</td>
                            <td>{{ $pet->species }}</td>
                            <td>{{ $pet->breed ?? 'N/A' }}</td>
                            <td>{{ ucfirst($pet->gender) }}</td>
                            <td>{{ $pet->age ?? 'N/A' }}</td>
                            <td>{{ $pet->owner->name ?? 'N/A' }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning btn-action">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('pets.destroy', $pet->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this pet?')" class="m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center p-3">No pets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $pets->links() }}
        </div>
    </div>
@endsection

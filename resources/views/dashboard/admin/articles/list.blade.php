@extends('dashboard.main')

@push('styles')
    <style>
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
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .table-modern td,
        .table-modern th {
            vertical-align: middle;
            border: none;
            padding: 12px 15px;
        }

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
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="mb-4 text-primary fw-bold"><i class="bx bx-book"></i> Articles</h2>

        {{-- Filters --}}
        <div class="filter-card">
            <form action="{{ route('admin.articles.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search Title or Content"
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i> Filter</button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-modern align-middle text-center">
                <thead>
                    <tr>
                        <th class="text-white">#</th>
                        <th class="text-white">Title</th>
                        <th class="text-white">Category</th>
                        <th class="text-white">Excerpt</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $articles->firstItem() + $loop->index }}</td>
                            <td>{{ $article['title'] }}</td>
                            <td>{{ $article['category'] }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($article['content'], 50, '...') }}</td>
                            <td class="d-flex flex-wrap justify-content-center gap-2">
                                <!-- View Modal Button -->
                                <button type="button" class="btn btn-info btn-action btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#articleModal{{ $article['id'] }}">
                                    <i class="bx bx-show"></i>
                                </button>

                                <!-- Edit Button -->
                                <a href="{{ route('admin.articles.edit', $article['id']) }}" 
                                    class="btn btn-warning btn-action btn-sm">
                                    <i class="bx bx-edit-alt"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.articles.destroy', $article['id']) }}" 
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this article?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="articleModal{{ $article['id'] }}" tabindex="-1"
                            aria-labelledby="articleModalLabel{{ $article['id'] }}" aria-hidden="true"
                            data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content rounded-4 shadow">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title text-white" id="articleModalLabel{{ $article['id'] }}">
                                            <i class="bx bx-book-open me-1"></i> Article Details
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <p><strong>Title:</strong> {{ $article['title'] }}</p>
                                        <p><strong>Category:</strong> {{ $article['category'] }}</p>
                                        <p><strong>Content:</strong></p>
                                        <div class="p-2 bg-light rounded">
                                            {!! nl2br(e($article['content'])) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('admin.articles.edit', $article['id']) }}" 
                                            class="btn btn-primary">Edit Article</a>
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection

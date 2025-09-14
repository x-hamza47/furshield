@extends('dashboard.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        @foreach ($stats as $label => $value)
            <div class="col-md-3 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="card-title text-capitalize">{{ str_replace('_', ' ', $label) }}</h6>
                        <h3 class="fw-bold">{{ $value }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Articles - Pet Care</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Snippet 1 Styles -->
    <link rel="stylesheet" href="{{ asset('site/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><span class="flaticon-pawprint-1 mr-2"></span>PetCare</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item active"><a href="{{ route('articles') }}" class="nav-link">Articles</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('site/images/bg_1.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-3 bread">Articles</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ url('/') }}">Home <i
                                    class="fa fa-chevron-right"></i></a></span>
                        <span>Articles <i class="fa fa-chevron-right"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Section -->
    <section class="ftco-section bg-light">
        <div class="container">

            <!-- Filter/Search Form -->
            <form method="GET" action="{{ route('articles') }}" class="mb-5 row">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search articles..."
                        value="{{ $search }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-control">
                        <option value="">-- All Categories --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ $cat == $category ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </form>

            <!-- Article Cards -->
            <div class="row d-flex">
                @forelse($articles as $article)
                    <div class="col-md-4 d-flex ftco-animate">
                        <a href="{{ route('article.show', $article['id']) }}">
                            <div class="blog-entry align-self-stretch">
                                <div class="text p-4 d-block">
                                    <small
                                        class="badge-primary text-white fs-6 d-inline p-1 rounded">{{ $article['category'] }}</small>
                                    <h3 class="heading mt-2" style="font-weight: bold">
                                        {{ $article['title'] }}
                                    </h3>
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($article['content'], 100, '...') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No articles found.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">PetCare</h2>
                        <p>Your trusted partner in pet health and happiness.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Quick Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}" class="py-2 d-block">Home</a></li>
                            <li><a href="{{ route('articles') }}" class="py-2 d-block">Articles</a></li>
                            <li><a href="#" class="py-2 d-block">Services</a></li>
                            <li><a href="#" class="py-2 d-block">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map-marker"></span><span class="text">203 Fake St.
                                        San Francisco, CA</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+1
                                            123 456 789</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span
                                            class="text">info@petcare.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        &copy; {{ date('Y') }} PetCare - All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('site/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('site/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('site/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('site/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('site/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>

</body>

</html>

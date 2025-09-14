<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pet Sitting - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><span class="flaticon-pawprint-1 mr-2"></span>PetCare</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('articles') }}" class="nav-link">Articles</a></li>
                    <li class="nav-item"><a href="#faq" class="nav-link">FAQ</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('site/images/bg_1.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-11 ftco-animate text-center">
                    <h1 class="mb-4">The smart way to manage your pet's health and happiness.</h1>

                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light ftco-no-pt ftco-intro">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                    <div class="d-block services active text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-blind"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Pet Owners</h3>
                            <p>Easily manage vet visits, vaccinations, grooming, and daily routines—all in one place.
                                Stay organized and give your pets the care they deserve, without the hassle.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                    <div class="d-block services text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-dog-eating"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Pet Shelters</h3>
                            <p>Animal shelters offer safe care for abandoned and rescued pets. They provide food,
                                medical help, and work to connect animals with loving families through adoption
                                programs.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                    <div class="d-block services text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-grooming"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Pet Veterinarian</h3>
                            <p>Experienced vets provide regular checkups, vaccinations, and treatments to keep pets
                                healthy. From preventive care to emergency support, veterinary services ensure your
                                furry friends live long, happy lives.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb" id="about">
        <div class="container">
            <div class="row d-flex no-gutters">
                <div class="col-md-5 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0"
                        style="background-image:url({{ asset('site/images/about-1.jpg') }});">
                    </div>
                </div>
                <div class="col-md-7 pl-md-5 py-md-5">
                    <div class="heading-section pt-md-5">
                        <h2 class="mb-4">Why Choose Us?</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-stethoscope"></span>
                            </div>
                            <div class="text pl-3">
                                <h4>Flexible Slots</h4>
                                <p>Book appointments at times that fit your schedule with our vet’s customizable
                                    availability.</p>
                            </div>
                        </div>
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-customer-service"></span>
                            </div>
                            <div class="text pl-3">
                                <h4>Easy Rescheduling</h4>
                                <p>Plans changed? Quickly reschedule your appointments without long calls or extra
                                    hassle.</p>
                            </div>
                        </div>
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-emergency-call"></span>
                            </div>
                            <div class="text pl-3">
                                <h4>Emergency Services</h4>
                                <p>When urgent care is needed, our vets are ready with fast and reliable support for
                                    your pets.</p>
                            </div>
                        </div>
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-veterinarian"></span>
                            </div>
                            <div class="text pl-3">
                                <h4>Trusted Veterinary Help</h4>
                                <p>Experienced vets offering health checkups, treatments, and expert care your pets
                                    deserve.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="ftco-counter" id="section-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="{{ $petCount }}">0</strong>
                        </div>
                        <div class="text">
                            <span>Pets</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="{{ $vetCount }}">0</strong>
                        </div>
                        <div class="text">
                            <span>Vets</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="{{ $shelterCount }}">0</strong>
                        </div>
                        <div class="text">
                            <span>Shelters</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="{{ $ownerCount }}">0</strong>
                        </div>
                        <div class="text">
                            <span>Owners</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light ftco-faqs" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-md-last">
                    <div class="img d-flex align-self-stretch align-items-center justify-content-center mb-4 mb-sm-0"
                        style="background-image: url('https://hips.hearstapps.com/hmg-prod/images/best-guard-dogs-1650302456.jpeg?crop=0.754xw:1.00xh;0.0651xw,0&resize=1200:*'); background-size: cover; background-position: center; height: 100%; width: 100%; border-radius: 10px;">
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="heading-section mb-5 mt-5 mt-lg-0">
                        <h2 class="mb-3">Frequently Questions Answered</h2>
                    </div>
                    <div id="accordion" class="myaccordion w-100" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header p-0" id="headingOne">
                                <h2 class="mb-0">
                                    <button href="#collapseOne"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <p class="mb-0">What are the steps to teach a dog basic obedience?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse show" id="collapseOne" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="card-body py-3 px-0">
                                    <ol>
                                        <li>Start with simple commands like <strong>“sit”</strong>,
                                            <strong>“stay”</strong>, <strong>“come”</strong>.
                                        </li>
                                        <li>Use <strong>positive reinforcement</strong> (treats or praise) for correct
                                            behavior.</li>
                                        <li>Keep training sessions <strong>short and consistent</strong> (5–10 minutes
                                            daily).</li>
                                        <li>Practice in a <strong>distraction-free environment</strong> first, then
                                            gradually add distractions.</li>
                                        <li>Be patient and <strong>never punish</strong>—redirect and reinforce instead.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0" id="headingTwo" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseTwo"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <p class="mb-0">What’s the proper way to care for your pets?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body py-3 px-0">
                                    <ol>
                                        <li>Provide a balanced diet and fresh water at all times.</li>
                                        <li>Ensure regular veterinary checkups and vaccinations.</li>
                                        <li>Give your pet daily exercise and mental stimulation.</li>
                                        <li>Keep their living environment clean and safe.</li>
                                        <li>Offer affection and social interaction regularly.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0" id="headingThree" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseThree"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <p class="mb-0">Which grooming practices are ideal for pets?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-body py-3 px-0">
                                    <ol>
                                        <li>Brush your pet’s coat regularly to reduce shedding and matting.</li>
                                        <li>Bathe your pet as needed using pet-safe shampoo.</li>
                                        <li>Trim nails every few weeks to prevent overgrowth.</li>
                                        <li>Clean ears gently to avoid infections.</li>
                                        <li>Brush teeth regularly or provide dental chews.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0" id="headingFour" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseFour"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <p class="mb-0">What do you need to start pet sitting?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseFour" role="tabpanel" aria-labelledby="headingFour">
                                <div class="card-body py-3 px-0">
                                    <ol>
                                        <li>Basic knowledge of pet care and behavior.</li>
                                        <li>Emergency contact info and vet details for the pet.</li>
                                        <li>Supplies like food, water bowls, toys, and bedding.</li>
                                        <li>Clear communication with the pet owner about routines.</li>
                                        <li>Patience, reliability, and a love for animals.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">FurShield</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Unleash the Paw-sibilities</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">About</a></li>
                            <li><a href="#" class="py-2 d-block">Services</a></li>
                            <li><a href="#" class="py-2 d-block">Vets</a></li>
                            <li><a href="#" class="py-2 d-block">Pricing</a></li>
                            <li><a href="#" class="py-2 d-block">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Services</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Pet Adoption</a></li>
                            <li><a href="#" class="py-2 d-block">Pet Boarding</a></li>
                            <li><a href="#" class="py-2 d-block">Veterinary</a></li>
                            <li><a href="#" class="py-2 d-block">Dog Walking</a></li>
                            <li><a href="#" class="py-2 d-block">Pet Grooming</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map-marker"></span><span class="text">203 Fake St.
                                        Mountain View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2
                                            392 3929 210</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template
                        is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


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

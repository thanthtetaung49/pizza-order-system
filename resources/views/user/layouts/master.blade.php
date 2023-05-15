<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Free HTML Templates">
    <meta name="description" content="Free HTML Templates">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block m-auto">
                <span class="h3 text-light">Pizza </span><span class="h3 text-warning">Express</span>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a class="text-decoration-none d-block d-lg-none" href="">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            @yield('navLink')
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <div class="d-inline-block">
                                <div class="dropdown d-inline-block" style="margin-right: 6rem">
                                    <a class="text-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                                       href="">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img class="rounded-circle me-2"
                                                     src="{{ asset('image/default_user.jpg') }}"
                                                     alt="male default photo" width="40px" height="40px">
                                            @else
                                                <img class="rounded-circle me-2"
                                                     src="{{ asset('image/female_default.png') }}"
                                                     alt="female default photo" width="40px" height="40px">
                                            @endif
                                        @else
                                            <img class="rounded-circle me-2"
                                                 src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->image }}"
                                                 width="40px" height="40px">
                                        @endif
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item py-2 mb-2" href="{{ route('user#userProfile') }}"><i
                                                   class="fa-solid fa-user mr-2"></i>Account</a></li>
                                        <hr>
                                        <li><a class="dropdown-item py-2 mb-2"
                                               href="{{ route('user#changePassword') }}"><i
                                                   class="fa-solid fa-key mr-2"></i>Change
                                                Password</a></li>
                                        <li>
                                            <div class="dropdown-item py-2 mb-2">
                                                <form class="w-100" action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <div class="d-grid">
                                                        <button class="btn bg-dark text-light" type="submit"><i
                                                               class="fa-solid fa-power-off me-2"></i>Log out</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Breadcrumb Start -->
    @yield('breadcrumb')
    <!-- Breadcrumb End -->

    <!-- Shop Start -->
    @yield('content')
    <!-- Shop End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor.
                    Rebum
                    tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ route('user#homePage') }}"><i
                                   class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{ route('pizza#cartPage') }}"><i
                                   class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary" href="{{ route('user#contactUs') }}"><i
                                   class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ route('user#homePage') }}"><i
                                   class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{ route('pizza#cartPage') }}"><i
                                   class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary" href="{{ route('user#contactUs') }}"><i
                                   class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6 class="text-secondary text-uppercase mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                   class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                   class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                   class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a class="btn btn-primary back-to-top" href="#"><i class="fa fa-angle-double-up"></i></a>

    {{-- Bootstrap  --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
            integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
            integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>

    {{-- JavaScript --}}
    @yield('javaScriptSource')
</body>

</html>

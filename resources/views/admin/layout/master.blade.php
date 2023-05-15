<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin panel</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
          media="all">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
          media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    {{-- Fontawesom --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('category#listPage') }}">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub sidebar">
                            <a class="js-arrow text-decoration-none" href="{{ route('category#listPage') }}">
                                <i class="fa-solid fa-list"></i>Category List
                            </a>
                        </li>
                        <li class="sidebar">
                            <a class="js-arrow text-decoration-none" href="{{ route('menu#list') }}">
                                <i class="fa-solid fa-book-open"></i>Menu List
                            </a>
                        </li>
                        <li class="sidebar">
                            <a class="js-arrow text-decoration-none" href="{{ route('menu#orderList') }}">
                                <i class="fa-solid fa-bowl-food"></i>Order List
                            </a>
                        </li>
                        <li class="sidebar">
                            <a class="js-arrow text-decoration-none" href="{{ route('admin#userList') }}">
                                <i class="fa-solid fa-users"></i>User List
                            </a>
                        </li>
                        <li class="sidebar">
                            <a class="js-arrow text-decoration-none" href="{{ route('customer#feedback') }}">
                                <i class="fa-solid fa-paper-plane"></i>Customer Message
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            @yield('search')
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default_user.jpg') }}"
                                                         alt="default user" width="40px" height="40px">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}"
                                                         alt="female_default" width="40px" height="40px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                     alt="admin image" width="40px" height="40px" />
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none"
                                               href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->image == null)
                                                        @if (Auth::user()->gender == 'male')
                                                            <img src="{{ asset('image/default_user.jpg') }}"
                                                                 alt="default user" width="40px" height="40px">
                                                        @else
                                                            <img src="{{ asset('image/female_default.png') }}"
                                                                 alt="female_default" width="40px" height="40px">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                             alt="admin image" width="40px" height="40px" />
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a class="text-decoration-none"
                                                           href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a class="text-decoration-none" href="{{ route('admin#info') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a class="text-decoration-none"
                                                       href="{{ route('admin#adminsList') }}">
                                                        <i class="fa-solid fa-users"></i></i>Admins List</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a class="text-decoration-none"
                                                       href="{{ route('admin#changePasswordPage') }}">
                                                        <i class="fa-solid fa-key"></i>Change Password</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer">
                                                <form class="d-flex justify-content-center my-3"
                                                      action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button class="btn bg-dark text-light col-10" type="submit">
                                                        <i class="zmdi zmdi-power me-2"></i>Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield('content')
        </div>
        <!-- END PAGE CONTAINER-->
    </div>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Jquery JS-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    @yield('jsSourceScript')
</body>

</html>
<!-- end document-->

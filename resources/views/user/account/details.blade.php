@extends('user.layouts.master')

@section('navLink')
    <a class="nav-item nav-link" href="{{ route('user#homePage') }}">Home</a>
    <a class="nav-item nav-link" href="{{ route('pizza#cartPage') }}">My Cart</a>
    <a class="nav-item nav-link" href="{{ route('user#contactUs') }}">Contact</a>
@endsection

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
      <div class="container-fluid">
        <div class="col-10 offset-1">
          <div class="card">
            <div class="card-body">
              <div class="fs-5">
                <a class="text-decoration-none" href="{{ route('user#homePage') }}">
                  <i class="fas fa-arrow-left text-dark"></i>
                </a>
              </div>

              <div class="card-title">
                <h3 class="text-center title-2">Account Profile</h3>
              </div>
              <hr>

              @if (session('userUpdateSuccess'))
                <div class="col-4 offset-8 mb-3">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('userUpdateSuccess') }}</strong>
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                  </div>
                </div>
              @endif

              <div class="row">
                <div class="col-3 offset-2">
                  @if (Auth::user()->image == null)
                    @if (Auth::user()->gender == 'male')
                      <img src="{{ asset('image/default_user.jpg') }}" alt="default user"
                           width="100%">
                    @else
                      <img src="{{ asset('image/female_default.png') }}" alt="female_default"
                           width="100%">
                    @endif
                  @else
                    <img class="shadow-sm" src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->image }}"
                          width="100%" />
                  @endif

                  <div class="d-grid my-3 rounded-3">
                    <a class="btn bg-dark text-light" href="{{ route('user#editProfile') }}">Edit profile<i
                         class="fa-solid fa-arrow-right ms-2"></i></a>
                  </div>
                </div>
                <div class="col-5 offset-1">
                  <h5 class="my-3"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h5>
                  <h5 class="my-3"><i class="fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}</h5>
                  <h5 class="my-3"><i class="fa-solid fa-phone me-3"></i>{{ Auth::user()->phone }}</h5>
                  <h5 class="my-3"><i class="fa-solid fa-address-card me-3"></i>{{ Auth::user()->address }}</h5>
                  <h5 class="my-3"><i class="fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h5>
                  <h5 class="my-3"><i
                       class="fa-solid fa-calendar me-3"></i>{{ Auth::user()->created_at->format('d-M-y H:m') }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MAIN CONTENT-->
  @endsection

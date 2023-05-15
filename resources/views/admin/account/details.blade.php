@extends('admin.layout.master')

@section('search')
  <h3 class="form-header">Admin dashboard panel</h3>
@endsection

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
      <div class="container-fluid">
        <div class="col-10 offset-1">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h3 class="text-center title-2">Account Profile</h3>
              </div>
              <hr>

              @if (session('updateAccountInfo'))
                <div class="col-6 offset-6 mb-3">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateAccountInfo') }}</strong>
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                  </div>
                </div>
              @endif

              <div class="row">
                <div class="col-4 offset-1">
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
                         style="height: 250px" width="100%" />
                  @endif

                  <div class="d-grid my-3 rounded-3">
                    <a class="btn bg-dark text-light" href="{{ route('admin#edit') }}">Edit profile<i
                         class="fa-solid fa-arrow-right ms-2"></i></a>
                  </div>
                </div>
                <div class="col-5 offset-1">
                  <h4 class="my-3"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h4>
                  <h4 class="my-3"><i class="fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}</h4>
                  <h4 class="my-3"><i class="fa-solid fa-phone me-3"></i>{{ Auth::user()->phone }}</h4>
                  <h4 class="my-3"><i class="fa-solid fa-address-card me-3"></i>{{ Auth::user()->address }}</h4>
                  <h4 class="my-3"><i class="fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h4>
                  <h4 class="my-3"><i
                       class="fa-solid fa-calendar me-3"></i>{{ Auth::user()->created_at->format('d-M-y H:m') }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MAIN CONTENT-->
  @endsection

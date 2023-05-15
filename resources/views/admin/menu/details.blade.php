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
              <div class="fs-5">
                <a class="text-decoration-none" href="{{ route('menu#list') }}">
                  <i class="fas fa-arrow-left text-dark"></i>
                </a>
              </div>

              <div class="card-title">
                <h3 class="text-center title-2">Menu Details</h3>
              </div>
              <hr>

              <div class="row mt-4">
                <div class="col-4 offset-1">
                  <img class="img-thumbnail shadow-sm" src="{{ asset('storage/' . $menu->image) }}"
                       alt="{{ $menu->image }}" width="100%">
                </div>
                <div class="col-7">
                  <h2 class="text-decoration-underline">{{ $menu->name }}</h2>

                  <div class="mt-4">
                    <small class="bg-dark text-light p-2 d-inline-block rounded-3 mt-1"><i class="fa-solid fa-money-bill-wave me-2"></i>
                      {{ $menu->price }} Kyats</small>
                    <small class="bg-dark text-light p-2 d-inline-block rounded-3 mt-1"><i class="fa-regular fa-eye me-2"></i>{{ $menu->view_count }}
                      views</small>
                    <small class="bg-dark text-light p-2 d-inline-block rounded-3 mt-1"><i
                         class="fa-solid fa-hourglass-start me-2"></i>{{ $menu->waiting_time }} mins</small>

                    <small class="bg-dark text-light p-2 d-inline-block rounded-3 mt-1"><i
                         class="fa-solid fa-tag me-2"></i>{{ $menu->category_name }}</small>

                    <small class="bg-dark text-light p-2 d-inline-block rounded-3 mt-1"><i
                         class="fa-solid fa-calendar me-2"></i>{{ $menu->created_at->format('d-M-y') }}</small>
                  </div>

                  <div class="my-4">
                    <p><i class="fa-solid fa-circle-info me-2 mb-3"></i>Details</p>
                    <p>{{ $menu->description }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MAIN CONTENT-->
  @endsection

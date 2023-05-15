@extends('user.layouts.master')

@section('navLink')
    <a class="nav-item nav-link" href="{{ route('user#homePage') }}">Home</a>
    <a class="nav-item nav-link" href="{{ route('pizza#cartPage') }}">My Cart</a>
    <a class="nav-item nav-link" href="{{ route('user#contactUs') }}">Contact</a>
@endsection

@section('content')
  <div class="container">
    <div class="col-6 offset-3">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h3 class="text-center title-2">Change Password</h3>
          </div>
          <hr>
          @if (session('changed'))
            <div class="col-12">
              <div class="mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('changed') }}</strong>
                  <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
              </div>
            </div>
          @endif
          <form action="{{ route('user#userChangePassword') }}" method="post" novalidate="novalidate">
            @csrf
            <div class="form-group mb-3">
              <label class="control-label mb-1" for="old-password">Old Password</label>
              <input class="form-control @error('oldPassword') is-invalid @enderror @if (session('failed')) is-invalid @endif"
                     id="old-password" name="oldPassword" type="password" aria-required="true" aria-invalid="false"
                     placeholder="Old password...">
              @error('oldPassword')
                <div class="invalid-feedback">
                  <span>{{ $message }}</span>
                </div>
              @enderror
              @if (session('failed'))
                <div class="invalid-feedback">
                  <span>{{ session('failed') }}</span>
                </div>
              @endif
            </div>

            <div class="form-group mb-3">
              <label class="control-label mb-1" for="new-password">New Password</label>
              <input class="form-control @error('newPassword') is-invalid @enderror" id="new-password" name="newPassword"
                     type="password" aria-required="true" aria-invalid="false" placeholder="New password...">
              @error('newPassword')
                <div class="invalid-feedback">
                  <span>{{ $message }}</span>
                </div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label class="control-label mb-1" for="confirm-password">Confirm Password</label>
              <input class="form-control @error('confirmPassword') is-invalid @enderror" id="confirm-password"
                     name="confirmPassword" type="password" aria-required="true" aria-invalid="false"
                     placeholder="Confirm Password">
              @error('confirmPassword')
                <div class="invalid-feedback">
                  <span>{{ $message }}</span>
                </div>
              @enderror
            </div>

            <div class="d-grid mt-3">
              <button class="btn btn-lg btn-dark text-light btn-block" id="category-button" type="submit">
                <span id="category-button-amount">Change Password</span>
                <i class="fa-solid fa-circle-right"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

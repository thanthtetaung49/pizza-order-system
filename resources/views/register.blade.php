@extends('layouts.master')

@section('title', 'Register page')

@section('content')
  <div class="login-form">
    <form action="{{ route('register') }}" method="post">
      @csrf
      @error('terms')
        <small class="text-danger">{{ $message }}</small>
      @enderror
      <div class="form-group">
        <label>Username</label>
        <input class="au-input au-input--full @error('name')
                    is-invalid
                @enderror"
               name="name" type="text" placeholder="Username">
        @error('name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group">
        <label>Email Address</label>
        <input class="au-input au-input--full @error('email')
                    is-invalid
                @enderror"
               name="email" type="email" placeholder="Email">
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group">
        <label>Phone</label>
        <input class="au-input au-input--full @error('phone')
                    is-invalid
                @enderror"
               name="phone" type="number" placeholder="09xxxxxx">
        @error('phone')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group">
        <label>Address</label>
        <input class="au-input au-input--full @error('address')
                    is-invalid
                @enderror"
               name="address" type="text" placeholder="Address">
        @error('address')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group">
        <label>Gender</label>
        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
          <option value="">Choose your gender...</option>
          <option value="male" @if (old('gender') == 'male') selected @endif>Male</option>
          <option value="female" @if (old('gender') == 'female') selected @endif>Female</option>
        </select>
        @error('gender')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input class="au-input au-input--full @error('password')
                    is-invalid
                @enderror"
               name="password" type="password" placeholder="Password">
        @error('password')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input class="au-input au-input--full @error('password_confirmation')
                    is-invalid
                @enderror"
               name="password_confirmation" type="password" placeholder="Confirm Password">
        @error('password_confirmation')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
      <p>
        Already have account?
        <a href="{{ route('auth#loginPage') }}">Sign In</a>
      </p>
    </div>
  </div>
@endsection

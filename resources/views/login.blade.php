@extends('layouts.master')

@section('title', 'Login Page')

@section('content')
  <div class="login-form">
    @error('terms')
      <small class="text-danger">{{ $message }}</small>
    @enderror
    <form action="{{ route('login') }}" method="post">
      @csrf
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
        <label>Password</label>
        <input class="au-input au-input--full @error('password')
                    is-invalid
                @enderror"
               name="password" type="password" placeholder="Password">
        @error('password')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
      <p>
        Don't you have account?
        <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
      </p>
    </div>
  </div>
@endsection

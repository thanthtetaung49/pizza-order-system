@extends('user.layouts.master')

@section('navLink')
    <a class="nav-item nav-link" href="{{ route('user#homePage') }}">Home</a>
    <a class="nav-item nav-link" href="{{ route('pizza#cartPage') }}">My Cart</a>
    <a class="nav-item nav-link active" href="{{ route('user#contactUs') }}">Contact</a>
@endsection

@section('breadcrumb')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item" href="{{ route('user#homePage') }}">Home</a>
                    <a class="breadcrumb-item" href="{{ route('pizza#cartPage') }}">Shopping Cart</a>
                    <a class="breadcrumb-item active" href="{{ route('user#contactUs') }}">Contact</a>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col-6 offset-3 p-3 bg-light shadow-sm">
            <div class="text-center mb-3">
                <h3>Contact Us</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-paper-plane me-2"></i>{{ session('success') }}</strong>
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('user#contact') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Name...">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="text" placeholder="Emai...">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Type your message..."></textarea>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn bg-dark text-light rounded-pill" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

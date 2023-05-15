@extends('user.layouts.master')

@section('navLink')
    <a class="nav-item nav-link" href="{{ route('user#homePage') }}">Home</a>
    <a class="nav-item nav-link active" href="{{ route('pizza#cartPage') }}">My Cart</a>
    <a class="nav-item nav-link" href="{{ route('user#contactUs') }}">Contact</a>
@endsection

@section('breadcrumb')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item" href="{{ route('user#homePage') }}">Home</a>
                    <a class="breadcrumb-item" href="{{ route('pizza#cartPage') }}">Shopping Cart</a>
                    <a class="breadcrumb-item" href="{{ route('user#contactUs') }}">Contact</a>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <img class="w-100 h-100" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="mb-3">
                        <i class="fa-solid fa-eye me-2"></i>
                        <span class="pt-1">{{ $pizza->view_count + 1 }} views</span>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} Kyats</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>

                            <input class="form-control bg-secondary border-0 text-center" id="cartValue" type="text"
                                   value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="cartButton"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaLists as $list)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $list->image) }}"
                                     alt="{{ $list->image }}" style="height: 200px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                           class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                       href="{{ route('pizza#detailPage', $list->id) }}"><i
                                           class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $list->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $list->price }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

    {{-- Hidden data --}}
    <input id="userId" type="hidden" value="{{ Auth::user()->id }}">
    <input id="productId" type="hidden" value="{{ $pizza->id }}">
    <input id="viewCount" type="hidden" value="{{ $pizza->view_count }}">
@endsection

@section('javaScriptSource')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "/ajax/pizza/view",
                data: {
                    "productId": $("#productId").val(),
                    "viewCount": $("#viewCount").val()
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                }
            });


            $("#cartButton").click(function(e) {
                e.preventDefault();
                let cartValue = $("#cartValue").val();
                let userId = $("#userId").val();
                let productId = $("#productId").val();

                let data = {
                    "userId": userId,
                    "productId": productId,
                    "cartValue": cartValue
                };

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/ajax/cartData",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.condition == "success") {
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                });
            });
        });
    </script>
@endsection

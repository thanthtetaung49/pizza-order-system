@extends('user.layouts.master')

@section('navLink')
    <a class="nav-item nav-link active" href="{{ route('user#homePage') }}">Home</a>
    <a class="nav-item nav-link" href="{{ route('pizza#cartPage') }}">My Cart</a>
    <a class="nav-item nav-link" href="{{ route('user#contactUs') }}">Contact</a>
@endsection

@section('breadcrumb')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item active" href="{{ route('user#homePage') }}">Home</a>
                    <a class="breadcrumb-item" href="{{ route('pizza#cartPage') }}">Shopping Cart</a>
                    <a class="breadcrumb-item" href="{{ route('user#contactUs') }}">Contact</a>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="bg-dark text-light d-flex align-items-center justify-content-between mb-3 p-2">
                            <label class="my-auto">All Categories</label>
                            <span class="badge border font-weight-normal">{{ count($pizzas) }}</span>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <a class="text-dark text-decoration-none nav-link my-2" href="{{ route('user#homePage') }}">All
                                Pizza</a>
                            @foreach ($categories as $category)
                                <a class="text-dark text-decoration-none nav-link my-2"
                                   href="{{ route('pizza#filter', $category->id) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex justify-content-between">
                            <div class="d-inline-block">
                                <a class="btn px-0 mx-3 d-inline-block" href="{{ route('pizza#cartPage') }}">
                                    <span class="position-relative">
                                        <i class="fa-solid fa-cart-shopping text-dark fs-3" data-bs-toggle="tooltip"
                                           title="Order List"></i>
                                        <span
                                              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($carts) }}
                                        </span>
                                    </span>
                                </a>

                                <a class="btn px-0 mx-3 d-inline-block" href="{{ route('user#orderHistory') }}">
                                    <span class="position-relative">
                                        <i class="fa-solid fa-rectangle-list text-dark fs-3" data-bs-toggle="tooltip"
                                           title="Order History"></i>
                                        <span
                                              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($orders) }}
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="form-group">
                                    <select class="form-select" id="sorting" name="sorting">
                                        <option value="">Sorting</option>
                                        <option value="asc">Oldest</option>
                                        <option value="desc">Newest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="pizzaList">
                    @if (count($pizzas) != 0)
                        @foreach ($pizzas as $pizza)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}"
                                             alt="{{ $pizza->image }}" style="height: 210px;">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                   class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square"
                                               href="{{ route('pizza#detailPage', $pizza->id) }}"><i
                                                   class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                           href="">{{ $pizza->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $pizza->price }} kyats</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center text-muted mt-3 fs-1">There is no menu <i
                               class="fa-solid fa-face-sad-tear ms-2"></i>
                        </h3>
                    @endif
                </div>

                <div class="mt-3">
                    {{ $pizzas->links() }}
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    </div>
@endsection

@section('javaScriptSource')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#sorting").change(function(e) {
                e.preventDefault();
                let eventOption = $(this).val();
                if (eventOption == 'asc') {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/ajax/getData",
                        data: {
                            'status': 'asc'
                        },
                        dataType: "json",
                        success: function(response) {
                            let pizzaList = ``;

                            for (let i = 0; i < response.length; i++) {
                                const element = response[i];

                                pizzaList += `
                  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
              <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="{{ asset('storage/${element.image}') }}" alt="${element.image}"
                       style="height: 210px;">
                  <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                  </div>
                </div>
                <div class="text-center py-4">
                  <a class="h6 text-decoration-none text-truncate" href="">${element.name}</a>
                  <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5>${element.price} kyats</h5>
                  </div>
                  <div class="d-flex align-items-center justify-content-center mb-1">
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                  </div>
                </div>
              </div>
            </div>
                `;
                            }
                            $("#pizzaList").html(pizzaList);
                        }
                    });
                } else {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/ajax/getData",
                        data: {
                            'status': 'desc'
                        },
                        dataType: "json",
                        success: function(response) {
                            let pizzaList = ``;

                            for (let i = 0; i < response.length; i++) {
                                const element = response[i];
                                console.log(element);

                                pizzaList += `
                  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
              <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="{{ asset('storage/${element.image}') }}" alt="${element.name}"
                       style="height: 210px;">
                  <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                  </div>
                </div>
                <div class="text-center py-4">
                  <a class="h6 text-decoration-none text-truncate" href="">${element.name}</a>
                  <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5>${element.price} kyats</h5>
                  </div>
                  <div class="d-flex align-items-center justify-content-center mb-1">
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                  </div>
                </div>
              </div>
            </div>
                `;
                            }
                            $("#pizzaList").html(pizzaList);
                        }
                    });
                }

            });
        });
    </script>
@endsection

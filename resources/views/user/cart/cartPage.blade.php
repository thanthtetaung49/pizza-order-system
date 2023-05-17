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
                    <a class="breadcrumb-item active" href="{{ route('pizza#cartPage') }}">Shopping Cart</a>
                    <a class="breadcrumb-item" href="{{ route('user#contactUs') }}">Contact</a>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
  <!-- Cart Start -->
  <div class="container-fluid">
    <div class="row px-xl-5">
      <div class="col-lg-8 table-responsive mb-5">
        @if (count($cartdatas) != 0)
          <table class="table table-light table-borderless table-hover text-center mb-0">
            <thead class="thead-dark">
              <tr>
                <th></th>
                <th>Pizza Menu</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody class="align-middle">
              @foreach ($cartdatas as $cart)
                <tr class="table-row">
                  <td class="align-middle"><img class="shadow-sm" src="{{ asset('storage/' . $cart->image) }}"
                         alt="{{ $cart->image }}" style="width: 70px;">
                  </td>
                  <td class="align-middle">{{ $cart->product_name }}
                    <input id="cartId" name="cartId" type="hidden" value="{{ $cart->cart_id }}">
                    <input id="userId" name="userId" type="hidden" value="{{ $cart->user_id }}">
                    <input id="productId" name="productId" type="hidden" value="{{ $cart->product_id }}">
                  </td>
                  <td class="align-middle" id="cartPrice">{{ $cart->price }} Kyats</td>
                  <td class="align-middle">
                    <div class="input-group quantity mx-auto" style="width: 100px;">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-minus">
                          <i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <input class="form-control form-control-sm bg-secondary border-0 text-center quantity"
                             id="quantity" type="text" value="{{ $cart->quantity }}">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-plus">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </td>
                  {{-- hidden input --}}
                  <input id="hiddenTotalPrice" name="totalPrice" type="hidden"
                         value="{{ $cart->price * $cart->quantity }}">
                  <td class="align-middle total" id="total">{{ $cart->price * $cart->quantity }} Kyats</td>
                  <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                         class="fa fa-times"></i></button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="text-center mt-5">
            <h1 class="text-muted">There is no chosen menu <i class="fa-solid fa-face-sad-tear ms-2"></i></h1>
          </div>
        @endif
      </div>
      <div class="col-lg-4">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
            Summary</span></h5>
        <div class="bg-light p-30 mb-5">
          <div class="border-bottom pb-2">
            <div class="d-flex justify-content-between mb-3">
              <h6>Subtotal</h6>
              <h6 class="subTotal">{{ $subTotal }} Kyats</h6>
            </div>
            <div class="d-flex justify-content-between">
              <h6 class="font-weight-medium">Delivery</h6>
              <h6 class="font-weight-medium">{{ $deliFee }} Kyats</h6>
            </div>
          </div>
          <div class="pt-2">
            <div class="d-flex justify-content-between mt-2">
              <h5>Total</h5>
              <h5 class="totalCart">{{ $subTotal + $deliFee }} Kyats</h5>
            </div>
            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkout-btn" type="button">Proceed
              To Checkout</button>
            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clear-btn" type="button">Clear Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Cart End -->
@endsection

@section('javaScriptSource')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-plus").click(function(e) {
        e.preventDefault();

        let cartPrice = Number($(this).parents("tr").find("#cartPrice").text().replace("Kyats", ""));
        let quantity = $(this).parents('tr').find("#quantity").val();
        let hiddenTotalPrice = Number($(this).parents('tr').find("#hiddenTotalPrice").val());
        let totalPrice = $(this).parents('tr').find("#total");

        let total = cartPrice * quantity;

        totalPrice.text(`${total} Kyats`);
        cartSummary();
      });

      $(".btn-minus").click(function(e) {
        e.preventDefault();

        let cartPrice = Number($(this).parents("tr").find("#cartPrice").text().replace("Kyats", ""));
        let quantity = $(this).parents('tr').find("#quantity").val();
        let hiddenTotalPrice = Number($(this).parents('tr').find("#hiddenTotalPrice").val());
        let totalPrice = $(this).parents('tr').find("#total");

        let total = cartPrice * quantity;

        totalPrice.text(`${total} Kyats`);
        cartSummary();
      });

      $(".btnRemove").click(function(e) {
        e.preventDefault();

        let parentNode = $(this).parents('tr');
        let orderId = parentNode.find("#cartId").val();

        parentNode.remove();
        cartSummary();

        $.ajax({
          type: "get",
          url: "/ajax/order/clear",
          data: {
            "orderId": orderId
          },
          dataType: "json",
        });
      });

      function cartSummary() {
        let calTotalCartPrice = 0;

        $.each($(".table-row"), function(index, value) {
          let totalCart = Number($(value).find(".total").text().replace("Kyats", ""));
          calTotalCartPrice += totalCart;
        });

        $(".subTotal").text(`${calTotalCartPrice} Kyats`);
        $(".totalCart").text(`${calTotalCartPrice + 3000} Kyats`);
      }

      $("#checkout-btn").click(function(e) {
        e.preventDefault();
        let code = "C-" + Math.floor(Math.random() * 1000000000000);

        $.each($(".table-row"), function(index, value) {
          var data = {
            "userId": $(value).find("#userId").val(),
            "productId": $(value).find("#productId").val(),
            "quantity": $(value).find("#quantity").val(),
            "total": $(value).find("#hiddenTotalPrice").val(),
            "orderCode": code,
          }

          $.ajax({
            type: "get",
            url: "/ajax/orderList",
            data: data,
            dataType: "json",
            success: function(response) {
              console.log(response);
              if (response.status == "true") {
                window.location.href = "/user/home";
              }
            }
          });
        });

        let order = {
          "userId": $("#userId").val(),
          "code": code,
          "subTotal": Number($(".subTotal").text().replace("Kyats", ""))
        }

        $.ajax({
          type: "get",
          url: "/ajax/order",
          data: order,
          dataType: "json",
        });

      });

      $("#clear-btn").click(function (e) { 
        e.preventDefault();
        $(".table-row").remove();
        $(".subTotal").text("0 Kyats");
        $(".totalCart").text("3000 Kyats");

        $.ajax({
          type: "get",
          url: "/ajax/all/clear",
        });
      });

    });
  </script>
@endsection

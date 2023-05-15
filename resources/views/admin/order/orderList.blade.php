@extends('admin.layout.master')

@section('search')
    <form class=" col-5 form-header" action="{{ route('menu#orderList') }}" method="get">
        @csrf
        <div class="input-group mb-3">
            <select class="form-select" id="status" name="orderStatus">
                <option value="">All</option>
                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                </option>
                <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept
                </option>
                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                </option>
            </select>
            <button class="btn btn-sm bg-dark text-light" type="submit">Search</button>
        </div>
    </form>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="d-flex justify-content-between mb-2">
                        <h2 class="title-1">Order List</h2>
                        <div class="">
                            <button class="btn btn-dark position-relative" type="button">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span
                                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($adminOrders) }}
                                </span>
                            </button>
                        </div>
                    </div>

                    @if (count($adminOrders) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Code</th>
                                        <th>Total Price</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($adminOrders as $adminOrder)
                                        <tr class="tr-shadow" id="tableRow">
                                            <input id="orderId" type="hidden" value="{{ $adminOrder->id }}">
                                            <td class="align-middle">
                                                {{ $adminOrder->user_id }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $adminOrder->user_name }}
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-decoration-none"
                                                   href="{{ route('products#info', $adminOrder->order_code) }}">
                                                    {{ $adminOrder->order_code }}
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                {{ $adminOrder->total_price }} Kyats
                                            </td>
                                            <td class="align-middle">
                                                {{ $adminOrder->created_at->format('M-d-Y') }}
                                            </td>
                                            <td class="align-middle">
                                                <select class="form-select form-select-sm orderStatus" name="status">
                                                    <option value="0"
                                                            @if ($adminOrder->status == 0) selected @endif>
                                                        Pending
                                                    </option>
                                                    <option value="1"
                                                            @if ($adminOrder->status == 1) selected @endif>
                                                        Accept
                                                    </option>
                                                    <option value="2"
                                                            @if ($adminOrder->status == 2) selected @endif>
                                                        Reject
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="text-muted text-center mt-5">There is no order list.</h3>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-3">
                        {{ $adminOrders->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('jsSourceScript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".orderStatus").change(function(e) {
                e.preventDefault();
                let orderStatusValue = $(this).val();
                let orderId = $(this).parents("#tableRow").find("#orderId").val();

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/ajax/admin/order/changeStatus",
                    data: {
                        "id": orderId,
                        "status": orderStatusValue
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection

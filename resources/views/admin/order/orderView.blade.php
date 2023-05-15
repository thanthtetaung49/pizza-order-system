@extends('admin.layout.master')

@section('search')
    <div class="form-header">
        <h3>Order Detail</h3>
    </div>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h4 class="text-light">Payment Voucher</h4>
                                    <small class="text-danger">include delivery charges</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <span> <i class="fa-solid fa-user text-danger me-2"></i> Customer Name</span>
                                        </div>
                                        <div class="col-6">
                                            {{ $orderInfos[0]->user_name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span><i class="fa-solid fa-barcode text-success me-2"></i>Order Code</span>
                                        </div>
                                        <div class="col-6">
                                            {{ $orderInfos[0]->order_code }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span><i class="fa-solid fa-money-bill text-primary me-2"></i>Total
                                                Price</span>
                                        </div>
                                        <div class="col-6">
                                            {{ $totalPrice->total_price }} Kyats
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($orderInfos) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>View</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($orderInfos as $orderInfo)
                                        <tr>
                                            <td class="align-middle">{{ $orderInfo->id }}</td>
                                            <td class="align-middle">{{ $orderInfo->product_name }}</td>
                                            <td class="align-middle col-2">
                                                <img src="{{ asset('storage/' . $orderInfo->product_image) }}"
                                                     alt="{{ $orderInfo->image }}">
                                            </td>
                                            <td class="align-middle">{{ $orderInfo->total }} Kyats</td>
                                            <td class="align-middle">{{ $orderInfo->quantity }}</td>
                                            <td class="align-middle">{{ $orderInfo->product_view }} views</td>
                                            <td class="align-middle">{{ $orderInfo->created_at->format('M-d-Y') }}</td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="text-muted text-center mt-5">There is no menu list here!
                        </h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('jsSourceScript')
<script type="text/javascript">
    $(document).ready(function () {
        $(".card-header").css({
            cursor : "pointer"
        });

        $(".card-header").click(function (e) { 
            e.preventDefault();
            $(".card-body").toggle();
        });
    });
</script>
    
@endsection

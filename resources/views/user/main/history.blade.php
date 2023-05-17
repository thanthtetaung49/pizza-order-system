@extends('user.layouts.master')

@section('navLink')
    <a class="nav-item nav-link" href="{{ route('user#homePage') }}">Home</a>
    <a class="nav-item nav-link" href="{{ route('pizza#cartPage') }}">My Cart</a>
    <a class="nav-item nav-link" href="{{ route('user#contactUs') }}">Contact</a>
@endsection

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                @if (count($orders) != 0)
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order Time</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle">{{ $order->created_at->format('M/d/Y') }}</td>
                                    <td class="align-middle">{{ $order->order_code }}</td>
                                    <td class="align-middle">{{ $order->total_price }} Kyats</td>
                                    <td class="align-middle">
                                        @if ($order->status == 0)
                                            <span class="text-warning"><i
                                                   class="fa-regular fa-hourglass-half me-2"></i>Pending...</span>
                                        @elseif ($order->status == 1)
                                            <span class="text-success"><i
                                                   class="fa-solid fa-circle-check me-2"></i>Success...</span>
                                        @else
                                            <span class="text-danger"><i
                                                   class="fa-solid fa-circle-xmark me-2"></i>Rejected...</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center mt-5">
                        <h1 class="text-muted">There is no order history <i class="fa-solid fa-face-sad-tear ms-2"></i></h1>
                    </div>
                @endif
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!-- Cart End -->
    @endsection

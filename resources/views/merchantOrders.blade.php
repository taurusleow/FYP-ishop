@extends('layout.merchantLayout')

@section('content')

<!--
@author Leow Soon Kuan
-->

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Customer Orders</h4>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead>
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Address</th>
                                <th>Cart ID</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    @if($order->status != "Delivered" && $order->status != "Refund Requested" && $order->status != "Refund Accepted" && $order->status != "Refund Denied" && $order->status != "Accepted")
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customerID }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->cartID }}</td>
                                            <td>RM {{ $order->total }}</td>
                                            <td>{{ $order->orderDate }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>
                                                <a href="/merchantEditOrder/{{ $order->id }}"><button class="btn btn-primary">Edit</button></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

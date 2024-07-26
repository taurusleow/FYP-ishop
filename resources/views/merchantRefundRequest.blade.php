@extends('layout.merchantLayout')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Refund Request</h4>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead style="text-align: center;">
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Address</th>
                                <th>Cart ID</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>

                            <tbody style="text-align: center;">
                                @foreach ($refunds as $refund)
                                    @if($refund->status == "Refund Requested")
                                        <tr>
                                            <td>{{ $refund->id }}</td>
                                            <td>{{ $refund->customerID }}</td>
                                            <td width="50%">{{ $refund->address }}</td>
                                            <td>{{ $refund->cartID }}</td>
                                            <td>RM {{ $refund->total }}</td>
                                            <td>{{ $refund->orderDate }}</td>
                                            <td>{{ $refund->status }}</td>
                                            <td>
                                                <a href="/merchantViewRequest/{{ $refund->id }}"><button class="btn btn-primary">View</button></a> 
                                            </td>
                                        </tr>
                                    @elseif($refund->status == "Refund Accepted" || $refund->status == "Refund Denied")
                                        <tr>
                                            <td>{{ $refund->id }}</td>
                                            <td>{{ $refund->customerID }}</td>
                                            <td>{{ $refund->address }}</td>
                                            <td>{{ $refund->cartID }}</td>
                                            <td>RM {{ $refund->total }}</td>
                                            <td>{{ $refund->orderDate }}</td>
                                            <td>{{ $refund->status }}</td>
                                            <td><b>No action</b></td>
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

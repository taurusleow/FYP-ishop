@extends('layout.merchantLayout')

@section('content')
    <style>
        th,td{
            text-align: center;
        }
    </style>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right">Sales Report</h3>
                    </div>

                    <div>
                        <h4> 
                            Total number of order has been placed: 
                                <?php
                                    $countPending = DB::table('orders')
                                            ->where('status', "=", "Pending")
                                            ->count();

                                    $countPackaging = DB::table('orders')
                                            ->where('status', "=", "Packaging")
                                            ->count();
                                    
                                    $countDelivering = DB::table('orders')
                                            ->where('status', "=", "Delivering")
                                            ->count();

                                    $countDelivered = DB::table('orders')
                                            ->where('status', "=", "Delivered")
                                            ->count();

                                    $countAccepted = DB::table('orders')
                                            ->where('status', "=", "Accepted")
                                            ->count();

                                    $count = $countPending + $countPackaging + $countDelivering + $countDelivered + $countAccepted;
                                    
                                    echo $count;
                                ?>
                        </h4>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover" id="sortTable">
                            <thead>
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customerID }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>RM {{ $order->total }}</td>
                                    <td>{{ $order->orderDate }}</td>
                                    <td>{{ $order->status }}</td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#sortTable').DataTable();
    </script>
@endsection
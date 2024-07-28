@extends('layout.merchantLayout')

@section('content')

<!--
@author Leow Soon Kuan
-->

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
                        <h3 class="text-right">Refund Report</h3>
                    </div>

                    <div>
                        <h4>
                            Total number of Return and Refund Request:
                                <?php
                                    $count = DB::table('orders')
                                            ->where('status', 'Refund Requested')
                                            ->orWhere('status', 'Refund Accepted')
                                            ->orWhere('status', 'Refund Denied')
                                            ->count();

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
                                @foreach ($refunds as $refund)
                                <tr>
                                    <td>{{ $refund->id }}</td>
                                    <td>{{ $refund->customerID }}</td>
                                    <td width="50%">{{ $refund->address }}</td>
                                    <td>RM {{ $refund->total }}</td>
                                    <td>{{ $refund->orderDate }}</td>
                                    <td>{{ $refund->status }}</td>
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

@extends('layout.homeLayout')
@section('content')

<!--
@author Leow Soon Kuan
-->

    <style>
        .profileLinksContainer {
            width: 100%;
            margin: auto;
            height: auto;
            text-align: center;
        }

        .profileLink {
            color: black;
            width: 16%;
            text-align: center;
            height: 35px;
            line-height: 35px;
            display: inline-block;
            margin: auto;
            transition: .1s;
        }

        .profileLink:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #576649;
        }

        .address-container {
            color: black;
            width: 100%;
            text-align: left;
            height: 50px;
            line-height: 50px;
            margin: auto;
            transition: .1s;
        }

        .address-container:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        @media screen and (max-width: 1400px) {
            .profileLink {
                width: 100%;
            }
        }

        th,
        td {
            text-align: center;
        }

        a {}
    </style>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="profileLinksContainer">
            <a href="/profile" class="profileLink">My Profile</a>
            <a href="/userAddress" class="profileLink">My Address Book</a>
            <a href="/payMethod" class="profileLink">My Payment Method</a>
            <a href="/prodRec" class="profileLink">My Shopping Preferences</a>
            <a href="/userOrderStatus" class="profileLink">Order Status</a>
            <a href="/userOrderHistory" class="profileLink">Order History</a>
        </div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Order History</h4>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Order Status</th>
                                <th colspan="2">Action</th>
                            </thead>

                            <tbody>
                                <tr>
                                    @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->orderDate }}</td>
                                    <td width="40%">{{ $order->address }}</td>
                                    <td>RM {{ $order->total }}</td>
                                    <td>{{ $order->status }}</td>

                                    @if ($order->status == 'Accepted')
                                        <td>
                                            Order has been Accepted. No action!
                                        </td>
                                    @elseif($order->status == 'Refund Requested')
                                        <td>
                                            Order is under refund process. No action!
                                        </td>
                                    @elseif ($order->status == 'Refund Accepted')
                                        <td>
                                            Order refund is accepted. No action!
                                        </td>
                                    @elseif ($order->status == 'Refund Denied')
                                        <td>
                                            Order refund is denied. No action!
                                        </td>
                                    @else
                                        <td>
                                            <?php echo '<a class="btn btn-primary btn-sm" href="/userAcceptOrder/' . "{$order->id}" . '">Accept Order</a>'; ?>
                                            <?php echo '<a class="btn btn-danger btn-sm" href="/returnandrefund/' . "{$order->id}" . '">Return and Refund</a>'; ?>
                                        </td>
                                    @endif

                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@extends('layout.homeLayout')
@section('content')
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

        th,td{
            text-align: center;
        }
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
                        <h4 class="text-right">Order Status</h4>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover">
                            
                            <thead>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                            @foreach($orders as $order)
                            <tr>    
                                <?php
                                    $startdate = "{$order->orderDate}";
                                    $expire = strtotime("+2 days", strtotime($startdate));
                                    $convertToText = date('Y-m-d', $expire);
                
                                    $status = "{$order->status}";

                                    echo '<td>'."{$order->id}".'</td>';
                                    echo '<td>'."{$order->orderDate}".'</td>';
                                    echo '<td width="50%">'."{$order->address}".'</td>';
                                    echo '<td>RM '."{$order->total}".'</td>';
                                    echo '<td>'."{$order->status}".'</td>';
                                    
                                    if(strtotime($startdate) < strtotime($convertToText) && $status == "Packaging" || $status == "Delivering" || $status == "Delivered"){
                                        echo '<td><a class="btn btn-primary btn-sm" href="/userViewOrder/'."{$order->id}".'">View Status</a></td>';
                                    }
                                    else {
                                        echo '<td><a class="btn btn-primary btn-sm" href="/userEditOrderAddress/'."{$order->id}".'">Edit Address</a></td>';
                                    }
                                ?>
                            </tr>
                            @endforeach
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

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

        th,td{
            text-align: center;
        }

        .stepper-wrapper {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            
            @media (max-width: 768px) {
                font-size: 12px;
            }
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
        }

        .stepper-item.active {
            font-weight: bold;
        }

        .stepper-item.completed .step-counter {
            background-color: #4bb543;
        }

        .stepper-item.completed::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #4bb543;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 3;
        }

        .stepper-item:first-child::before {
            content: none;
        }
        .stepper-item:last-child::after {
            content: none;
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
                        <h4 class="text-right">View Order</h4>
                    </div>

                    <div class="stepper-wrapper">
                        @if($orders->status == "Packaging")
                            <div class="stepper-item completed">
                                <div class="step-counter">1</div>
                                <div class="step-name"><b>Packaging</b></div>
                                <p>Merchant is packaging your order.</p>
                            </div>

                            <div class="stepper-item">
                                <div class="step-counter">2</div>
                                <div class="step-name">Delivering</div>
                            </div>

                            <div class="stepper-item">
                                <div class="step-counter">3</div>
                                <div class="step-name">Delivered</div>
                            </div>
                        @endif

                        @if($orders->status == "Delivering")
                            <div class="stepper-item completed">
                                <div class="step-counter">1</div>
                                <div class="step-name">Packaging</div>
                            </div>

                            <div class="stepper-item completed">
                                <div class="step-counter">2</div>
                                <div class="step-name"><b>Delivering</b></div>
                                <p style="text-align: center;">Merchant has hand over the parcel to delivery company to handle.</p>
                            </div>

                            <div class="stepper-item">
                                <div class="step-counter">3</div>
                                <div class="step-name">Delivered</div>
                            </div>
                        @endif

                        @if($orders->status == "Delivered")
                            <div class="stepper-item completed">
                                <div class="step-counter">1</div>
                                <div class="step-name">Packaging</div>
                            </div>

                            <div class="stepper-item completed">
                                <div class="step-counter">2</div>
                                <div class="step-name">Delivering</div>
                            </div>

                            <div class="stepper-item completed">
                                <div class="step-counter">3</div>
                                <div class="step-name"><b>Delivered</b></div>
                                <p>Delivery Company has delivered your order.</p>
                            </div>
                        @endif
                    </div>

                    <div class="row mt-3">
                        <form action="{{action('App\Http\Controllers\OrderDetailsController@update', $id)}}" method="POST">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">

                            <div class="mb-3">
                                <label for="id" class="form-label">ID: </label>
                                <input type="text" class="form-control" id="id" name="id" value="{{$orders->id}}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="orderDate" class="form-label">Order Date: </label>
                                <input type="text" class="form-control" id="orderDate" name="orderDate" value="{{$orders->orderDate}}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address: </label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$orders->address}}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label">Total (RM): </label>
                                <input type="number" class="form-control" id="total" name="total" value="{{$orders->total}}" readonly>
                            </div>
                        </form>

                        <div class="mt-3">
                            <h3>Order Detail's</h3>

                            <table class="table table-hover">
                                <thead>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                </thead>

                                <tbody>
                                        <tr>
                                            <td>{{$order_details->productID}}</td>
                                            <td>{{$products->productName}}</td>
                                            <td><img width="110px" height="130px" src="/productImg/{{ $order_details->productImage }}" alt="Product Image"></td>
                                            <td>{{$order_details->quantity}}</td>
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
    </div>
@endsection
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
            <a href="/userShoppingPreferences" class="profileLink">My Shopping Preferences</a>
            <a href="/userOrderStatus" class="profileLink">Order Status</a>
            <a href="/userOrderHistory" class="profileLink">Order History</a>
        </div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Return and Refund</h4>
                    </div>

                    <div class="row mt-3">
                        <form action="{{action('App\Http\Controllers\OrderDetailsController@store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

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

                            <div class="mb-3">
                                <label for='imgDamageProduct' class='form-label'>Damage Product Image: </label>
                                <input id="dmgProdImg" name="dmgProdImg" type="file" enctype="multipart/form-data">
                                
                                <br/>
                                
                                <img id="showDmgImg" src="#" width="200px" alt="Product Image" />
                                
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason: </label>
                                <textarea class="form-control" name="reason" placeholder="Describe the damaged product.." style="height:200px"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Send Request</button>
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
                                            <td>{{ $order_details->productID }}</td>
                                            <td>{{ $products->productName }}</td>
                                            <td><img width="110px" height="130px" src="/productImg/{{ $order_details->productImage }}" alt="Product Image"></td>
                                            <td>{{ $order_details->quantity }}</td>
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

    <script>
        const damageImg = document.getElementById("dmgProdImg");

        damageImg.onchange = evt => {
            const [file] = damageImg.files;
            if (file) {
                showDmgImg.src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection

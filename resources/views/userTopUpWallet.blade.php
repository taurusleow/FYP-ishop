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

        @media screen and (max-width: 1400px) {
            .profileLink {
                width: 100%;
            }
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
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Top Up Wallet Balance</h4>
                    </div>

                    <form action="{{action('App\Http\Controllers\PayMethodController@topUpCharge')}}" method="POST" style="margin-left: 400px;">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Wallet ID</label>
                                <input type="text" class="form-control" name="id" value="{{$wallets->id}}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Customer Email</label>
                                <input type="text" class="form-control" name="email" value="{{$wallets->customerEmail}}" readonly>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Balance</label>
                                <input id="text" type="text" class="form-control" name="balance" value="RM {{$wallets->balance}}" readonly>
                            </div>

                            <div class="mt-1 col-md-12">
                                <label class="labels">Top Up Amount</label>
                                <input type="number" class="form-control" name="topUpAmount">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-success" name="submit" type="submit" style="float: right;">
                                Top Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

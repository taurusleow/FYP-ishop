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
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if (isset($customerprofile[0]->customerImg))
                        <img class="rounded-circle mt-5" width="150px" src="/customerImg/{{ $customerprofile[0]->customerImg }}">
                    @else
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    @endif

                    <span class="font-weight-bold">{{ $userprofile->lastName . ' ' . $userprofile->firstName }}</span>
                    <span class="text-black-50">{{ $customerprofile[0]->email }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Payment</h4>
                        <a href="/payMethod/create"><button type="button" class="btn btn-outline-primary"><i
                                    class="fa-regular fa-plus"></i> Add New</button></a>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead>
                                <th></th>
                                <th>Payment Company</th>
                                <th>Card No.</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($paymethods as $paymethod)
                                    <tr>
                                        <td style="max-width: 150px;">
                                            <h5>{{ $paymethod->paymentName }}</h5>
                                            <p>
                                                {{  $paymethod->paymentType }}
                                            </p>
                                        </td>
                                        <td style="max-width: 150px;">
                                            <p>
                                                {{ $paymethod->paymentCompany }}
                                            </p>
                                        </td>
                                        <td style="max-width: 150px;">
                                            <p>
                                                {{ $paymethod->cardNo }}
                                            </p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <a href="/payMethod/{{ $paymethod->id }}"><button
                                                    class="btn btn-outline-warning">Edit</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $paymethods->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">iShop Wallet</h4>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead style="text-align: center;">
                                <th>Customer Email</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </thead>

                            <tbody style="text-align: center;">
                                <tr>
                                    <td>{{$wallets->customerEmail}}</td>
                                    <td>RM {{$wallets->balance}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="/userTopUpWallet">Top Up Balance</a>
                                    </td>
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

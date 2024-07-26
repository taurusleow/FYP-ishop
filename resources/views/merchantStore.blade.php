@extends('layout.homeLayout')
@section('content')
    <style>
        .card-img-top {
            width: 150px;
            margin: auto;
        }
    </style>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if (isset($store->merchantImg))
                        <img class="rounded-circle mt-5" width="150px" src="/merchantImg/{{ $store->merchantImg }}">
                    @else
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    @endif

                    <span class="font-weight-bold">
                        @if ($store->authorisedMerchant == 1)
                            <i class="fa-solid fa-user-check" style="color: #576649;"></i>
                        @endif
                        {{ $store->merchantName }}
                    </span>
                    <span class="text-black-50">
                        @if ($store->authorisedMerchant == 1)
                            [Authorised Merchant]
                        @else
                            [Unauthorised Merchant]
                        @endif
                    </span>
                    <span class="text-black-50">{{ $store->merchantCategory }}</span>
                    <span class="text-black-50">{{ $store->merchantState }}, {{ $store->merchantCountry }}</span>
                    <span class="text-black-50">{{ $store->merchantDesc }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Store's Products</h4>
                    </div>
                    <div class="container text-center">
                        @php
                            $productSize = sizeof($products);
                            $productIndex = 0;
                        @endphp
                        @while ($productSize > 0)
                            <div class="row" style="margin-top:30px;">
                                @for ($i = 0; $i < 3; $i++)
                                    @if (isset($products[$productIndex]))
                                        <div class="col">
                                            <div class="card" style="min-height: 300px;">
                                                <div style="min-height: 150px;">
                                                    <img src="/productImg/{{ $products[$productIndex]->image1 }}"
                                                        class="card-img-top" alt="...">
                                                </div>
                                                <div class="card-body">

                                                    <h4 class="card-title">
                                                        @if ($products[$productIndex]->authentication == 1)
                                                            <i class="fa-sharp fa-solid fa-circle-check"
                                                                style="color: #576649;"></i>
                                                        @endif
                                                        {{ $products[$productIndex]->productName }}

                                                    </h4>
                                                    <h5 class="card-title">RM {{ $products[$productIndex]->productPrice }}
                                                    </h5>
                                                    <a href="/product/{{ $products[$productIndex]->productID }}"
                                                        class="btn btn-primary">View
                                                        Product</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @php
                                        $productIndex++;
                                        $productSize--;
                                    @endphp
                                @endfor
                            </div>
                        @endwhile

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

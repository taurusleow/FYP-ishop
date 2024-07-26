@extends('layout.adminLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Merchant submission for authentication for store</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead>
                                <th>Store Image</th>
                                <th>Store's detail</th>
                                <th>Store's Description</th>
                                <th>Store's Location</th>
                                <th>Supporting Document</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($merchants as $merchant)
                                    <tr>
                                        <td style="max-width: 120px;">
                                            <img class="rounded" height="90px"
                                                src="/merchantImg/{{ $merchant->merchantImg }}">
                                        </td>
                                        <td style="max-width: 150px;">
                                            <h5>{{ $merchant->merchantName }}</h5>
                                            <p>Category: {{ $merchant->merchantCategory }}</p>
                                        </td>
                                        <td style="max-width: 150px;">
                                            <p>{{ $merchant->merchantDesc }}</p>
                                        </td>
                                        <td style="max-width: 150px;">
                                            <p>{{ $merchant->merchantState }}, {{ $merchant->merchantCountry }}</p>
                                        </td>
                                        <td>
                                            <a href="/merchantAuthenticate/{{ $merchant->fileName }}" download>
                                                Supporting Document
                                            </a>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <a href="/approveMerchant/{{ $merchant->merchantID }}"><button
                                                    class="btn btn-outline-primary">Approve</button></a>
                                            <a href="/declineMerchant/{{ $merchant->merchantID }}"><button
                                                    class="btn btn-outline-warning">Decline</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $merchants->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

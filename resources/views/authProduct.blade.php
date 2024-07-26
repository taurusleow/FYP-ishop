@extends('layout.adminLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Merchant submission for authentication for products</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover">
                            <thead>
                                <td>Image</td>
                                <td>Product Name</td>
                                <td>Price</td>
                                <td>Status</td>
                                <td>Documents</td>
                                <td></td>
                            </thead>
                            <tbody>
                                @foreach ($products as $listProd)
                                    <tr>
                                        <td style="max-width: 120px;">
                                            <img class="rounded" height="90px" src="/productImg/{{ $listProd->image1 }}">
                                        </td>
                                        <td style="max-width: 150px;">
                                            <h5>{{ $listProd->productName }}</h5>
                                            <p>Category: {{ $listProd->category }}</p>
                                        </td>
                                        <td style="max-width: 120px;">
                                            <p>Price: RM{{ $listProd->productPrice }}</p>
                                        </td>
                                        <td style="max-width: 120px;">
                                            <p>Status: {{ $listProd->status }}</p>
                                        </td>
                                        <td>
                                            <a href="/productAuthenticate/{{ $listProd->fileName }}" download>
                                                Supporting Document
                                            </a>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <a href="/approveProduct/{{ $listProd->productID }}"><button
                                                    class="btn btn-outline-primary">Approve</button></a>
                                            <a href="/declineProduct/{{ $listProd->productID }}"><button
                                                    class="btn btn-outline-warning">Decline</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

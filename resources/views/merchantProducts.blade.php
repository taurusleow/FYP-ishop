@extends('layout.merchantLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Products in shop</h4>
                        <a href="/merchantAddProduct"><button type="button" class="btn btn-outline-primary"><i
                                    class="fa-regular fa-plus"></i> Add New</button></a>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover">
                            <tbody>
                                @foreach ($products as $listProd)
                                    <tr>
                                        <td style="max-width: 120px;">
                                            <img class="rounded" height="90px"
                                                src="/productImg/{{ $listProd->image1 }}">
                                        </td>
                                        <td style="max-width: 150px;">
                                            <h5>{{ $listProd->productName }}</h5>
                                            <p>Category: {{ $listProd->category }}</p>
                                        </td>
                                        <td style="max-width: 120px;">
                                            <p>Price: RM{{ $listProd->productPrice }}</p>
                                            <p>Stock: {{ $listProd->productStock }}</p>
                                        </td>
                                        <td style="max-width: 120px;">
                                            <p>Status: {{ $listProd->status }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <a href="/merchantProducts/{{ $listProd->productID }}"><button
                                                    class="btn btn-outline-primary">View</button></a>
                                            <a href="/merchantEditProducts/{{ $listProd->productID }}"><button
                                                    class="btn btn-outline-warning">Edit</button></a>
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

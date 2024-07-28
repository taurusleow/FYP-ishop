@extends('layout.merchantLayout')

@section('content')

<!--
@author Leow Soon Kuan
-->

    <div class="container rounded bg-white mt-5 mb-5" id="registerFormContainer" style="width: 50%;">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <h4 class="text-right">Edit Order Status</h4>
                    </div>

                    <form action="{{action('App\Http\Controllers\MerchantOrderController@update', $id)}}" method="POST">
                        @csrf

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="id" class="form-label">Order ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{$orders[0]->id}}" readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$orders[0]->address}}" readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="total" class="form-label">Total (RM)</label>
                                <input type="number" class="form-control" id="total" name="total" value="{{$orders[0]->total}}" readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="status" class="form-label">Status's</label>
                                <select class="form-select" id="status" name="status" aria-label=".form-select-sm example">
                                    <option value="">Select Status's</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Packaging">Packaging</option>
                                    <option value="Delivering">Delivering</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="status" class="form-label">Update Date</label>
                                <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{$orders[0]->updated_at}}">
                            </div>
                        </div>
                        
                        <br/>
                        
                        <div>
                            <button style="float: right;" type="submit" class="btn btn-primary">Edit Status</button>
                        </div>
                    </form>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <h4 class="text-right">Order Details</h4>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <th>Product Image</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td><img width="110px" height="130px" src="/productImg/{{ $order->productImage }}" alt="Product Image"></td>
                                    <td>{{ $order->productID }}</td>
                                    <td>{{ $order->productName }}</td>
                                    <td>{{ $order->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
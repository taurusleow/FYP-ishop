@extends('layout.homeLayout')

@section('content')
<div style="margin-top: 80px; margin-left: 100px;">
    <div>
        <h2>Payment</h2>
    </div>

    <div style="width: 40%; float: left; margin-right: 50px;">
    <table class="table table-hover">
        <thead>
            <th>Product Image</th>
            <th>Product Name</th>
            <th style="text-align: center;">Quantity</th>
            <th style="text-align: center;">Subtotal</th>
        </thead>

        @if(count($cartItems) > 0)
            @for($i=0; $i < count($cartItems); $i++)
            <tr>
                <td><img width="110px" height="130px" src="/productImg/{{ $cartItems[$i]->productImage }}" alt="Product Image" ></td>
                <td>{{$products[$i]->productName}}</td>
                <td style="text-align: center;">{{$cartItems[$i]->quantity}}</td>
                <td style="text-align: center;">RM {{$products[$i]->productPrice * $cartItems[$i]->quantity}}</td>
            </tr>
            @endfor
        @else
        <tr>
            <td colspan="4" style="text-align: center;"><b>Currently no items added to your cart for you to make payment.</b></td>
        </tr>
        @endif
    </table>
    </div>

    <div style="width: 30%; float: right; margin-right: 250px;">
        <form action="{{action('App\Http\Controllers\PaymentController@update', $cartItems[0]->cartID)}}" method="POST">
        @csrf
            <input name="_method" type="hidden" value="PATCH">
            
            <table class="table table-hover">
                <h3>Order Summary</h3>
                <tbody>
                    <tr>
                        <td><b>Subtotal</b><td>
                        <td>RM {{$carts->subtotal}}</td>
                    </tr>
                    <tr>
                        <td><b>Service Charge (6%)</b><td>
                        <td>RM {{round($carts->subtotal * 0.06, 2)}}</td>
                    </tr>
                    <tr>
                        <td><b>Grand Total</b><td>
                        <td>RM {{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}</td>
                    </tr>
                    <tr>
                        <td><td>
                        <td><button type="submit" class="btn btn-primary">Make Payment</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

@endsection
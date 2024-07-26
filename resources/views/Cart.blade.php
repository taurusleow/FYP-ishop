@extends('layout.homeLayout')

@section('content')

<div style="max-width: 1000px; margin: 80px auto auto auto;">
    <div>
        <h2>Cart</h2>
    </div>

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
                <form action="{{action('App\Http\Controllers\CartController@update', $cartItems[$i]->id)}}" method="POST">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <input name="price" type="hidden" value="{{$products[$i]->productPrice}}">
                    <input name="subtotal" type="hidden" value="{{$products[$i]->productPrice * $cartItems[$i]->quantity}}">

                    <td><img width="110px" height="130px" src="/productImg/{{ $cartItems[$i]->productImage }}" alt="Product Image" ></td>

                    <td>{{$products[$i]->productName}}</td>
                    <td style="text-align: center;"><input type="number" name="quantity" min="1" value="{{$cartItems[$i]->quantity}}" style="max-width: 50px;"/></td>

                    <td style="text-align: center;">RM {{$products[$i]->productPrice * $cartItems[$i]->quantity}}</td>

                    <td style="text-align: center;"><button type="submit" class="btn btn-primary">Edit</button></td>
                    <td style="text-align: center;"><a class="btn btn-danger" href="/cart/{{$cartItems[$i]->id}}/del">Remove</a></td>
                </form>
            </tr>
            @endfor
        @else
        <tr>
            <td colspan="4" style="text-align: center;"><b>Currently No items added to your cart. Click [Browse Product] to add items to your cart.</b></td>
        </tr>
        @endif
    </table>
    
    <a href="/product" class="btn btn-secondary" style="float: left;">Browse Product</a>
    
    @if(count($cartItems) > 0)
        <a href="/orderConfirmation" class="btn btn-success" style="float: right;">Checkout</a>
    @endif

    <br/><br/><br/> 

    <div>
        <h2>Most Sold Product</h2>
    </div>

    <table class="table table-hover" >
        <thead style="text-align: center;">
            <th>Product Name</th>
            <th>Available Stock</th>
            <th>Subtotal</th>
        </thead>

        <tbody style="text-align: center;">
            @foreach ($products as $product)
                @if($product->productSold != 0)
                    <tr>
                        <td>{{ $product->productName }}</td>
                        <td>{{ $product->productStock }}</td>
                        <td>RM {{ $product->productPrice }}</td>
                        <td>
                            <a href="/product/{{ $product->id }}"><button class="btn btn-primary">View</button></a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="4"><b>Currently no products has the most sold number.</b></td>
                    <tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Observers\PaymentData;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @author Leow Soon Kuan <index, create, edit, destroy functions>
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user == NULL){
            return view("auth.login");
        }

        $getCustomerEmail = Auth::user()->email;
        $getCustomerID = DB::table('customers')->where('email', $getCustomerEmail)->get();
        $customerID = $getCustomerID[0]->id;

        $cart = Cart::where('customerID', $customerID)->where('status', 'Cart')->get();
        $cartExist = Cart::where('customerID', $customerID)->where('status', 'Cart')->get()->count();

        $product = DB::select('SELECT DISTINCT product_images.image1, products.productName, products.productStock, products.productPrice, products.id, products.productSold FROM products INNER JOIN cart_items ON products.id = cart_items.productID INNER JOIN product_images ON product_images.id = products.id order by products.productSold DESC LIMIT 5');

        $cartItems = array();
        $getProduct = array();

        if($cartExist > 0){
            $cartItems = CartItems::where('cartID', $cart[0]->id)->get();

            $i = 0;

            foreach($cartItems as $ci){
                $getProduct[$i] = Product::find($ci->productID);
                $i++;
            }
        }

        return view('Cart', ['cartItems' => $cartItems], ['products' => $getProduct]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user == NULL){
            return view("auth.login");
        }

        $carts = new Cart();
        $cartItems = new CartItems();

        $getCustomerEmail = Auth::user()->email;
        $getCustomerID = DB::table('customers')->where('email', $getCustomerEmail)->get();
        $id = $getCustomerID[0]->id;

        $productID = $request->get('id');
        //$productImg = $request->get('image');

        $product = DB::table('products')->where('products.id', '=', $productID)->join('product_images', 'products.id', '=', 'product_images.productID')->first();

        $productPrice = $request->get('price');
        $productQuantity = $request->get('quantity');

        $getCart = Cart::where('customerID', $id)->where('status', 'Cart')->get();
        $isCartExisted = Cart::where('customerID', $id)->where('status', 'Cart')->get()->count();

        if($isCartExisted>0){
            $getCart[0]->subtotal += $productPrice * $productQuantity;
            $getCart[0]->save();

            $getCartItemExisted = CartItems::where('cartID', $getCart[0]->id)->where('productID', $productID)->get();
            $isExisted = CartItems::where('cartID', $getCart[0]->id)->where('productID', $productID)->get()->count();

            if($isExisted>0){
                $getCartItemExisted[0]->productImage = $product->image1;
                $getCartItemExisted[0]->quantity += $productQuantity;
                $getCartItemExisted[0]->save();
            }
            else{
                $cartItems->cartID = $getCart[0]->id;
                $cartItems->productImage = $product->image1;
                $cartItems->productID = $productID;
                $cartItems->quantity = $productQuantity;
                $cartItems->save();
            }
        }
        else{
            $carts->customerID = $id;
            $carts->subtotal = $productPrice * $productQuantity;
            $carts->status = 'Cart';
            $carts->save();

            $latest = Cart::latest()->first();
            $cartItems->cartID = $latest->id;
            $cartItems->productID = $productID;
            $cartItems->productImage = $product->image1;
            $cartItems->quantity = $productQuantity;
            $cartItems->save();
        }

        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartItem = CartItems::find($id);
        $product = Product::find($cartItem->productID);

        return view('editCart')->with('product', $product)->with('cartItem', $cartItem)->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $productPrice = $request->get('price');
        $productQuantity = $request->get('quantity');
        $subtotal = $request->get('subtotal');

        $cartItem = CartItems::find($id);
        $cart = Cart::find($cartItem->cartID);

        $cartItem->quantity = $productQuantity;
        $cart->subtotal -= $subtotal;
        $cart->subtotal += $productQuantity * $productPrice;

        $cartItem->save();
        $cart->update();

        return redirect('/cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cartItem = CartItems::find($id);
        $cartItem->delete();

        $deleteCart = DB::delete('DELETE FROM carts WHERE id="' . $cartItem->cartID . '"');

        return redirect('/cart');
    }
}

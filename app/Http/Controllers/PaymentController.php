<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Product;
use App\Observers\PaymentData;
use App\Models\Payment;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller {

    /**
     * Display a listing of the resource.
     * 
     * @author Leow Soon Kuan
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = Auth::user();

        if ($user == NULL){
            return view("auth.login");
        }

        $getCustomerEmail = Auth::user()->email;
        $getCustomerID = DB::table('customers')->where('email', $getCustomerEmail)->get();
        $customerID = $getCustomerID[0]->id;

        $cart = Cart::where('customerID', $customerID)->where('status', 'Cart')->get();
        $cartExist = Cart::where('customerID', $customerID)->where('status', 'Cart')->get()->count();
        $addresses = Address::where('customerEmail', $user->email)->get();
        $discountRate = 0;
        $latest = Cart::latest()->first();

        $cartData = DB::table('carts')
                    ->select('*')
                    ->where('customerID', '=', $customerID)
                    ->where('id', '=', $latest->id)
                    ->first();

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

        return view('orderConfirmation')->with('cartItems', $cartItems)
                        ->with('products', $getProduct)
                        ->with('addresses', $addresses)
                        ->with('carts', $cartData)
                        ->with('discountRate', $discountRate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = Auth::user();

        if ($user == NULL){
            return view("auth.login");
        }

        $getCustomerEmail = Auth::user()->email;
        $getCustomerID = DB::table('customers')->where('email', $getCustomerEmail)->get();
        $customerID = $getCustomerID[0]->id;

        $cart = Cart::where('customerID', $customerID)->where('status', 'Cart')->get();
        $cartExist = Cart::where('customerID', $customerID)->where('status', 'Cart')->get()->count();
        $addresses = Address::where('customerEmail', $user->email)->get();
        $voucherMessage = null;
        $discountRate = 0;

        $cartData = DB::table('carts')
                    ->select('*')
                    ->where('customerID', '=', $customerID)
                    ->first();

        $cartItems = array();
        $getProduct = array();

        $cartItem = CartItems::find($id);

        if ($cartItem != NULL){
            $customerID = Auth::user()->id;

            if($cartExist > 0){
                $cartItems = CartItems::where('cartID', $cart[0]->id)->get();

                $i = 0;

                foreach($cartItems as $ci){
                    $getProduct[$i] = Product::find($ci->productID);
                    $i++;
                }
            }

            return redirect('/payment');

        }else {
            return redirect('/payment');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}

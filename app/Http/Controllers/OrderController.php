<?php

namespace App\Http\Controllers;

use Omnipay\Omnipay;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PayPal;
use App\Models\Wallet;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\CartItems;
use App\Models\OrderDetails;

use App\Observers\SendEmail;
use App\Observers\CartUpdate;
use App\Observers\PaymentData;
use App\Observers\ProductUpdate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\SecurityClass\ValidateTngPayment;
use App\SecurityClass\ValidateCardPayment;

class OrderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

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
                    ->latest()->first();

        $wallet = DB::table('wallets')
                    ->select('*')
                    ->where('customerEmail', '=', $user->email)
                    ->latest()->first();

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

        return view('/payment')->with('cartItems', $cartItems)
                        ->with('products', $getProduct)
                        ->with('addresses', $addresses)
                        ->with('carts', $cartData)
                        ->with('discountRate', $discountRate)
                        ->with('wallets', $wallet);
    }

    public function orderStatus()
    {
        $orders = DB::select('select * from orders');
        return view('adminChangeOrderStatus', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
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

        $cartData = DB::table('carts')
                    ->select('*')
                    ->where('customerID', '=', $customerID)
                    ->latest()->first();

        $cartDetails = DB::table('cart_items')
                        ->select('*')
                        ->where('cartID', '=', $cartData->id)
                        ->first();

        $updateProductNo = DB::table('products')
                        ->select('*')
                        ->where('id', '=', $cartDetails->productID)
                        ->latest()->first();

        $cartItems = array();
        $getProduct = array();

        $paymentType = $request->get("paymentType");
        $card = $request->get("card");
        $cvv = $request->get("cvv");
        $address = $request->get("address");
        $total = $request->get("total");

        if ($paymentType == "card") {
                $validateInput = new ValidateCardPayment(htmlspecialchars($card), htmlspecialchars($cvv));

                if ($validateInput->checkInput() == "") {
                    $order = new Order();
                    $order->customerID = $customerID;
                    $order->cartID = $cartData->id;
                    $order->total = $total;
                    $order->orderDate = date("Y-m-d h:i:s");
                    $order->address = $address;
                    $order->status = "Pending";
                    $order->save();

                    $latest = Order::latest()->first();
                    $detailID = OrderDetails::latest()->first();

                    $payment = new Payment();
                    $payment->orderID = $latest->id;
                    $payment->total = ($cartData->subtotal + $cartData->subtotal * 0.06) - ($discountRate * ($cartData->subtotal + $cartData->subtotal * 0.06));
                    $payment->paymentDate = date("Y-m-d h:i:s");
                    $payment->paymentMethod = htmlspecialchars($request->get("paymentType"));

                    if ($payment->save()) {
                        $updateCart = DB::table('carts')
                                        ->where('id', $cartData->id)
                                        ->update(['status' => "Paid"]);

                        $insertDetails = DB::table('order_details')
                                        ->insert([
                                        'orderID' => $order->id,
                                        'productID' => $cartDetails->productID,
                                        'productImage' => $cartDetails->productImage,
                                        'quantity' => $cartDetails->quantity,
                                        'created_at' => date("Y-m-d h:i:s")]);

                        $updateProduct = DB::table('products')
                                        ->where('id', '=', $cartDetails->productID)
                                        ->update(['productStock' => $updateProductNo->productStock - $cartDetails->quantity,
                                        'productSold' => $updateProductNo->productSold + $cartDetails->quantity]);
                    }

                    return redirect('/userOrderStatus');

                } else {
                    $messages = explode("|", $validateInput->checkInput());

                    /*return view('payment')->with('cartItem', $cartItem)
                                    ->with('cartProduct', $cartProduct)
                                    ->with('address', $getAddress)
                                    ->with('cart', $cart)
                                    ->with('discountRate', $discountRate)
                                    ->with('message', $messages);*/
                    return view('payment');
                }
        }elseif($paymentType == "paypal"){
            if(isset($_POST['submit'])){
                try {
                    $response = $this->gateway->purchase(array(
                        'amount' => $total,
                        'currency' => env('PAYPAL_CURRENCY'),
                        'returnUrl' => url('success'),
                        'cancelUrl' => url('error'),
                    ))->send();

                    if ($response->isRedirect()) {
                        $order = new Order();
                        $order->customerID = $customerID;
                        $order->cartID = $cartData->id;
                        $order->total = $total;
                        $order->orderDate = date("Y-m-d h:i:s");
                        $order->address = $address;
                        $order->status = "Pending";
                        $order->save();

                        $latest = Order::latest()->first();
                        $detailID = OrderDetails::latest()->first();

                        $payment = new Payment();
                        $payment->orderID = $latest->id;
                        $payment->total = ($cartData->subtotal + $cartData->subtotal * 0.06) - ($discountRate * ($cartData->subtotal + $cartData->subtotal * 0.06));
                        $payment->paymentDate = date("Y-m-d h:i:s");
                        $payment->paymentMethod = htmlspecialchars($request->get("paymentType"));

                        if ($payment->save()) {
                            $updateCart = DB::table('carts')
                                            ->where('id', $cartData->id)
                                            ->update(['status' => "Paid"]);

                            $insertDetails = DB::table('order_details')
                                            ->insert([
                                            'orderID' => $order->id,
                                            'productID' => $cartDetails->productID,
                                            'productImage' => $cartDetails->productImage,
                                            'quantity' => $cartDetails->quantity,
                                            'created_at' => date("Y-m-d h:i:s")]);
                            $updateProduct = DB::table('products')
                                            ->where('id', '=', $cartDetails->productID)
                                            ->update(['productStock' => $updateProductNo->productStock - $cartDetails->quantity,
                                            'productSold' => $updateProductNo->productSold + $cartDetails->quantity]);
                        }

                        $response->redirect(); // this will automatically forward the customer
                    } else {
                        // not successful
                        return $response->getMessage();
                    }
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }elseif($paymentType == "storeWallet"){
            $balance = $request->get('balance');

            if($balance > $total){
                $order = new Order();
                $order->customerID = $customerID;
                $order->cartID = $cartData->id;
                $order->total = $total;
                $order->orderDate = date("Y-m-d h:i:s");
                $order->address = $address;
                $order->status = "Pending";
                $order->save();

                $latest = Order::latest()->first();
                $detailID = OrderDetails::latest()->first();

                $payment = new Payment();
                $payment->orderID = $latest->id;
                $payment->total = ($cartData->subtotal + $cartData->subtotal * 0.06) - ($discountRate * ($cartData->subtotal + $cartData->subtotal * 0.06));
                $payment->paymentDate = date("Y-m-d h:i:s");
                $payment->paymentMethod = htmlspecialchars($request->get("paymentType"));

                if ($payment->save()) {
                    $updateCart = DB::table('carts')
                                    ->where('id', $cartData->id)
                                    ->update(['status' => "Paid"]);

                    $insertDetails = DB::table('order_details')
                                    ->insert([
                                    'orderID' => $order->id,
                                    'productID' => $cartDetails->productID,
                                    'productImage' => $cartDetails->productImage,
                                    'quantity' => $cartDetails->quantity,
                                    'created_at' => date("Y-m-d h:i:s")]);

                    $updateProduct = DB::table('products')
                                    ->where('id', '=', $cartDetails->productID)
                                    ->update(['productStock' => $updateProductNo->productStock - $cartDetails->quantity,
                                    'productSold' => $updateProductNo->productSold + $cartDetails->quantity]);

                    $updateWallet = DB::table('wallets')
                                    ->where('customerID', $customerID)
                                    ->update(['balance' => $balance - $total,
                                    'updated_at' => date("Y-m-d h:i:s")]);
                }

                return redirect('/userOrderStatus');

            }else{
                echo "<script>alert('Your wallet balance is not enough to make the payment!')</script>";

                return redirect('/cart');
            }
        }
    }

    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $payment = new PayPal();
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();

                echo "<script>alert('Payment is successful. Check your order status!')</script>";

                return redirect('/userOrderStatus');
            } else {
                return $response->getMessage();
            }
        } else {
            echo "<script>alert('Transaction is declined. Please do the payment again!')</script>";

            return redirect('/cart');
        }
    }

    public function error()
    {
        echo "<script>alert('You have cancelled the payment.')</script>";

        return redirect('/cart');
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

    public function viewOrder($id) {
        $orders = Order::find($id);

        $order_details = DB::table('order_details')
                    ->select('*')
                    ->where('orderID', '=', $orders->id)
                    ->latest()->first();

        $products = DB::table('products')
                    ->select('*')
                    ->where('id', '=', $order_details->productID)
                    ->latest()->first();

        return view('userViewOrder', ['orders' => $orders], ['id' => $id])
                ->with('order_details', $order_details)
                ->with('products', $products);
    }

    public function showOrder($id) {
        $orders = Order::find($id);

        $order_details = DB::table('order_details')
                    ->select('*')
                    ->where('orderID', '=', $orders->id)
                    ->latest()->first();

        $products = DB::table('products')
                    ->select('*')
                    ->where('id', '=', $order_details->productID)
                    ->latest()->first();

        return view('userAcceptOrder', ['orders' => $orders], ['id' => $id])
                ->with('order_details', $order_details)
                ->with('products', $products);
    }

    public function acceptOrder(Request $request, $id){
        $orders = Order::find($id);
        $orders->status = "Accepted";
        $orders->update();

        return redirect('/userOrderHistory');
    }

    public function edit($id) {
        $orders = Order::find($id);

        return view('editOrderStatus', ['orders' => $orders], ['id' => $id]);
    }

    public function editAddress($id) {
        $orders = Order::find($id);

        $order_details = DB::table('order_details')
                    ->select('*')
                    ->where('orderID', '=', $orders->id)
                    ->latest()->first();

        $products = DB::table('products')
                    ->select('*')
                    ->where('id', '=', $order_details->productID)
                    ->latest()->first();

        return view('userEditOrderAddress', ['orders' => $orders], ['id' => $id])
                ->with('order_details', $order_details)
                ->with('products', $products);
    }

    public function returnRequest($id) {
        $orders = Order::find($id);

        $order_details = DB::table('order_details')
                    ->select('*')
                    ->where('orderID', '=', $orders->id)
                    ->latest()->first();

        $products = DB::table('products')
                    ->select('*')
                    ->where('id', '=', $order_details->productID)
                    ->latest()->first();

        return view('returnandrefund', ['orders' => $orders], ['id' => $id])
                ->with('order_details', $order_details)
                ->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*public function update(Request $request, $id) {
        $orders = Order::find($id);
        $orders->status = $request->get('status');
        $orders->updated_at = $request->get('updated_at');

        $orders->save();

        return redirect('/adminChangeOrderStatus');
    }*/

    public function update(Request $request, $id) {
        $orders = Order::find($id);
        $orders->status = $request->get('status');
        $orders->updated_at = $request->get('updated_at');

        $orders->save();

        return redirect('/userOrderStatus');
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

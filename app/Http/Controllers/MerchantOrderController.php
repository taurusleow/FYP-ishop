<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetails;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MerchantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author Leow Soon Kuan <index, orderStatus, update, showRefund, viewRequest, updateRequest functions>
     * 
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $merchant = Auth::user();

        $products = DB::table('products')->where('merchantEmail', '=', $merchant->email);
        $orders = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.status != "Accepted" AND orders.status != "Delivered" AND orders.status != "Refund Requested" ORDER BY orders.id ASC');
        $order_details = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id where products.merchantEmail = "'.$merchant->email.'"');

        return view('merchantOrders', ['orders' => $orders], ['products' => $products])
            ->with('order_details', $order_details);
    }

    public function orderStatus($id)
    {
        $merchant = Auth::user();
        $id = Order::find($id);

        $orders = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.id = "'.$id->id.'"');

        return view('merchantEditOrder', ['orders' => $orders], ['id' => $id]);
    }

    public function showRefund(){
        $merchant = Auth::user();

        $refunds = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.status = "Refund Requested" OR orders.status = "Refund Accepted" OR orders.status = "Refund Denied"  ORDER BY order_details.orderId ASC');

        return view('merchantRefundRequest', ['refunds' => $refunds]);
    }

    public function viewRequest($id){
        $merchant = Auth::user();
        $id = Order::find($id);

        $refunds = DB::select('SELECT * FROM refund WHERE orderID = "'.$id->id.'"');
        $orders = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.id = "'.$id->id.'"');

        return view('merchantViewRequest', ['orders' => $orders], ['id' => $id])
                ->with('refunds', $refunds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return redirect('/merchantOrders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $orders = Order::find($id);
        $orders->status = $request->get('status');
        $orders->updated_at = $request->get('updated_at');

        $orders->save();

        return redirect('/merchantOrders');
    }

    public function updateRequest(Request $request, $id) {
        $orders = Order::find($id);
        $total = $request->get('total');

        $refund = DB::select('SELECT * FROM wallets INNER JOIN orders ON wallets.customerID = orders.customerID WHERE orders.id = "'.$orders->id.'"');

        $customerID = $refund[0]->customerID;
        $balance = $refund[0]->balance;
        $refundAmount = $balance + $total;

        if(isset($_POST['submit'])){
            //echo "<script>alert('$customerID and $balance and $refundAmount')</script>";

            $refund = DB::update('UPDATE wallets SET balance = "'.$refundAmount.'" WHERE customerID= "'.$customerID.'"');

            $orders->status = "Refund Accepted";
            $orders->updated_at = $request->get('updated_at');

            $orders->update();

            return redirect('/merchantRefundRequest');

        }elseif(isset($_POST['deny'])){
            //echo "<script>alert('Deny')</script>";

            $orders->status = "Refund Denied";
            $orders->updated_at = $request->get('updated_at');

            $orders->update();

            return redirect('/merchantRefundRequest');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

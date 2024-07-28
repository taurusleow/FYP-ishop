<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Refund;
use App\Models\OrderDetails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @author Leow Soon Kuan <index, viewOrder, editAddress, showHistory>
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $getCustomerEmail = Auth::user()->email;
        $getCustomerID = DB::table('customers')->where('email', $getCustomerEmail)->get();
        $user = $getCustomerID[0]->id;

        $orders = DB::select('SELECT * FROM orders WHERE customerID="' . $user . '" AND status !="Refund Requested" AND status !="Refund Denied" AND status !="Refund Accepted" AND status !="Accepted"');

        return view('userOrderStatus', ['orders' => $orders]);
    }

    public function showHistory(){
        $getCustomerEmail = Auth::user()->email;
        $getCustomerID = DB::table('customers')->where('email', $getCustomerEmail)->get();
        $user = $getCustomerID[0]->id;

        $orders = DB::select('select * from orders WHERE customerID="' . $user . '" AND status="Delivered" OR status="Accepted" OR status="Refund Requested" OR status="Refund Accepted" OR status="Refund Denied"');

        return view('userOrderHistory', ['orders' => $orders]);
    }

    public function orderAPI($orderID){
        $order = DB::select('SELECT id, memberID, total, address, orderDate FROM orders WHERE id="'. $orderID . '"');

        return $order;
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
        $damageImage = $request->file('dmgProdImg')->hashName();
        $request->file('dmgProdImg')->move(public_path('productImg'), $damageImage);

        $insertRequest = DB::table('refund')->insert(
            ['orderID' => $request->get('id'),
            'damageProdImg' => $damageImage,
            'reason' => $request->get('reason'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')]
            );

        $orders = Order::find($request->get('id'));
        $orders->status = "Refund Requested";

        $orders->update();

        return redirect('/userOrderHistory');
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
        $orders->address = $request->get('address');
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
    public function destroy($id)
    {
        //
    }
}

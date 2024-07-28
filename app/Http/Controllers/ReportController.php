<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @author Leow Soon Kuan <delivery, refund, sales functions>
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
    }

    public function delivery(){
        $merchant = Auth::user();

        $orders = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.status = "Delivered" OR orders.status = "Accepted" ORDER BY orders.id ASC');

        return view('deliveryReport', ['orders' => $orders]);
    }

    public function sales(){
        $merchant = Auth::user();

        $orders = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.status = "Pending" OR orders.status = "Delivering" OR orders.status = "Packaging" OR orders.status = "Delivered" OR orders.status = "Accepted" ORDER BY orders.id ASC');

        return view('salesReport', ['orders' => $orders]);
    }

    public function refund(){
        $merchant = Auth::user();

        $refunds = DB::select('SELECT * from order_details inner join products on order_details.productID = products.id inner join orders on order_details.orderId = orders.id where products.merchantEmail = "'.$merchant->email.'" AND orders.status = "Refund Requested" OR orders.status = "Refund Accepted" OR orders.status = "Refund Denied" ORDER BY orders.id ASC');

        return view('refundReport', ['refunds' => $refunds]);
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
        //
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
        //
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
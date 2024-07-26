<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vouchers;

class VoucherController extends Controller
{
    public function index(){
        $vouchers = Vouchers::all();

        return view('adminVouchers', ['vouchers' => $vouchers]);
    }

    public function create(){
        return view('adminAddVoucher');
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|max:20',
            'desc' => 'required|max:50',
            'discount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'sDate' => 'required',
            'eDate' => 'required',
        ]);

        $voucher = new Vouchers([
            "voucherCode" => $request->get('code'),
            "voucherDesc" => $request->get('desc'),
            "quantity" => $request->get('quantity'),
            "discountRate" => $request->get('discount')/100,
            "startDate" => $request->get('sDate'),
            "endDate" => $request->get('eDate'),
            "status" => "up"
        ]);

        $voucher->save();
        return redirect('/adminVouchers');
    }

    public function edit($id){
        $voucher = Vouchers::findOrFail($id);

        return view('adminEditVoucher', ['voucher' => $voucher]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'code' => 'required|max:20',
            'desc' => 'required|max:50',
            'discount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'sDate' => 'required',
            'eDate' => 'required',
        ]);

        $voucher = Vouchers::findOrFail($id);
        $voucher->voucherCode = $request->get('code');
        $voucher->voucherDesc = $request->get('desc');
        $voucher->discountRate = $request->get('discount')/100;
        $voucher->quantity = $request->get('quantity');
        $voucher->startDate = $request->get('sDate');
        $voucher->endDate = $request->get('eDate');

        $voucher->save();
        return redirect('/adminVouchers');
    }
}

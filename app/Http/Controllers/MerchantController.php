<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function index(){
        $merchant = Auth::user();
        $products = DB::table('products')->where('merchantEmail', '=', $merchant->email)
                                        ->join('product_images', 'products.id', '=', 'product_images.productID')->get();
        $orders = DB::table('orders')->where('orders.status', 'pending')
                                    ->join('order_details', 'orders.id', '=', 'order_details.orderID')
                                    ->join('products', 'order_details.productID', '=', 'products.id')
                                    ->where('products.merchantEmail', $merchant->email)
                                    ->get();
        $sales = DB::table('order_details')->join('products', 'order_details.productID', '=', 'products.id')
                                            ->where('products.merchantEmail', $merchant->email)
                                            ->select('order_details.*', 'products.productPrice')
                                            ->get();

        return view('merchantDashboard')->with('products', $products)
                                        ->with('orders', $orders)
                                        ->with('sales', $sales);
    }

    public function report(){
        $merchant = Auth::user();
        $sales = DB::table('order_details')->join('products', 'order_details.productID', '=', 'products.id')
                                            ->where('products.merchantEmail', $merchant->email)
                                            ->select('order_details.*', 'products.productPrice')
                                            ->get();
        $salesDetail = DB::table('order_details')->join('products', 'order_details.productID', '=', 'products.id')
                                                ->where('products.merchantEmail', $merchant->email)
                                                ->join('orders', 'order_details.orderID', '=', 'orders.id')
                                                ->join('customers', 'orders.customerID', '=', 'customers.id')
                                                ->select('customers.email', 'orders.address', 'order_details.quantity', 'order_details.created_at', 'products.*')
                                                ->paginate(30);

        return view('merchantSalesReport')->with('sales', $sales)
                                            ->with('salesDetail', $salesDetail);
    }

    public function profile(){
        $merchant = Auth::user();
        $userprofile = User::findOrFail($merchant->id);
        $merchantProfile = DB::table('merchants')->where('email', $merchant->email)->get();

        return view('merchantProfile', ['userprofile' => $userprofile], ['merchantProfile' => $merchantProfile]);
    }

    public function update(Request $request){
        $request->validate([
            'image' => 'mimes:jpeg,bmp,png,jpg',
            'imageDocs' => 'mimes:pdf',
            'storename' => 'required|max:50',
            'storeDescription' => 'required|min:1|max:255',
            'phoneNo' => 'required|min:8|max:12',
        ]);

        $user = User::findOrFail($request->get('userid'));
        $merchant = Merchant::findOrFail($request->get('merchantid'));
        $merchantAuthenticate = DB::table('merchant_authentications')->where('merchantID', '=', $merchant->id)->get();

        $fileName = null;
        $fileName2 = null;
        if($merchant->merchantImg != null){
            $fileName = $merchant->merchantImg;
        }
        if($merchantAuthenticate[0]->fileName != null){
            $fileName2 = $merchantAuthenticate[0]->fileName;
        }
        if($request->file('image')!= null){
            $fileName = $request->file('image')->hashName();
            $request->file('image')->move(public_path('merchantImg'), $fileName);
        }
        if($request->file('imageDocs')!= null){
            $fileName2 = $request->file('imageDocs')->hashName();
            $request->file('imageDocs')->move(public_path('merchantAuthenticate'), $fileName2);
        }

        $user->phoneNo = $request->get('phoneNo');
        $merchant->merchantName = $request->get('storename');
        $merchant->merchantCategory = $request->get('category');
        $merchant->merchantDesc = $request->get('storeDescription');
        $merchant->merchantImg = $fileName;
        $merchant->merchantCountry = $request->get('country');
        $merchant->merchantState = $request->get('state');

        if($fileName2!=null){
            DB::table('merchant_authentications')->where('merchantID', '=', $merchant->id)->update(['fileName' => $fileName2, 'status' => "pending"]);
        }

        $user->save();
        $merchant->save();

        return redirect('/merchantProfile');
    }
}

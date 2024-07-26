<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PopularCategories;
use App\Models\ProductSearch;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\MerchantAuthentications;
use App\Models\ProductAuthentications;

class AdminController extends Controller
{
    public function index(){
        $sales = Order::all();
        $totalCustomers = Customer::all()->count();
        $totalMerchant = Merchant::all()->count();
        $totalMerchantAuthentication = DB::table('merchant_authentications')->where('status', '=', 'pending')->count();
        $totalProductAuthentication = DB::table('product_authentications')->where('status', '=', 'pending')->count();

        return view('adminDashboard')->with('sales', $sales)
                                        ->with('totalCustomers', $totalCustomers)
                                        ->with('totalMerchant', $totalMerchant)
                                        ->with('totalMerchantAuthentication', $totalMerchantAuthentication)
                                        ->with('totalProductAuthentication', $totalProductAuthentication);
    }

    public function report(){
        $sales = Order::all();
        $productSearch = ProductSearch::all();
        $popularCategory = PopularCategories::all();

        return view('adminReports')->with('sales', $sales)
                                    ->with('productSearch', $productSearch)
                                    ->with('popularCategory', $popularCategory);
    }

    public function authMerchant(){
        $merchants = DB::table('merchant_authentications')->where('merchant_authentications.status', '=', 'pending')
                                                        ->join('merchants', 'merchant_authentications.merchantID', '=', 'merchants.id')
                                                        ->paginate(10);

        return view('authMerchant', ['merchants'=> $merchants]);
    }

    public function authProduct(){
        $products = DB::table('product_authentications')->where('product_authentications.status', '=', 'pending')->join('products', 'product_authentications.productID', '=', 'products.id')
                                                                                        ->join('product_images', 'product_authentications.productID', '=', 'product_images.productID')
                                                                                        ->paginate(10);

        return view('authProduct', ['products'=> $products]);
    }

    public function approve($id){
        DB::table('product_authentications')->where('productID', $id)->update(['status' => 'approved']);
        $product = Product::findOrFail($id);
        $product->authentication = 1;
        $product->save();

        return redirect('/authProduct');
    }

    public function decline($id){
        DB::table('product_authentications')->where('productID', $id)->update(['status' => 'failed']);
        return redirect('/authProduct');
    }

    public function approveM($id){
        DB::table('merchant_authentications')->where('merchantID', $id)->update(['status' => 'approved']);
        $merchant = Merchant::findOrFail($id);
        $merchant->authorisedMerchant = 1;
        $merchant->save();

        return redirect('/authMerchant');
    }

    public function declineM($id){
        DB::table('merchant_authentications')->where('merchantID', $id)->update(['status' => 'failed']);
        return redirect('/authMerchant');
    }
}

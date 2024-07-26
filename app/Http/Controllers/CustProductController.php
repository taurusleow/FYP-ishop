<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Merchant;
use App\Models\ProductRecommends;
use App\Models\ProductSearch;
use App\Models\PopularCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustProductController extends Controller
{
    public function index(){
        if(Auth::check()){
            $customer = Auth::user();
            $query = Product::query();
            $products = $query->join('product_images', 'products.id', '=', 'product_images.productID')
                                ->join('product_recommends', function ($join) {
                                    $customer = Auth::user();
                                    $join->on('products.category', '=', 'product_recommends.productCategory')
                                        ->where('product_recommends.customerEmail', '=', $customer->email);
                                })
                                ->orderBy('product_recommends.rate', 'desc')
                                ->select('products.*', 'product_images.image1')
                                ->paginate(30);
            return view('product', ['products' => $products]);
        }
        else{
            $products = DB::table('products')->join('product_images', 'products.id', '=', 'product_images.productID')->paginate(30);
        }
        return view('product', ['products' => $products]);
    }

    public function merchantStore($id){
        $store = Merchant::findOrFail($id);
        $products = DB::table('products')->where('products.merchantEmail', '=', $store->email)
                                        ->join('product_images', 'products.id', '=', 'product_images.productID')
                                        ->paginate(30);

        return view('merchantStore')->with('store', $store)
                                    ->with('products', $products);
    }

    public function prodCat(){
        if(request('category')!=""){
            $category = urldecode(request('category'));
            $products = DB::table('products')->where('category', $category)->join('product_images', 'products.id', '=', 'product_images.productID')->paginate(30);
        }

        return view('product', ['products' => $products]);
    }

    public function search(Request $request){
        $query = Product::query();
        $getKeyword = ProductSearch::all();
        $searchMerchant = null;
        if($request->get('search') != ""){
            if(sizeof($getKeyword) > 0){
                $found = false;
                foreach($getKeyword as $key){
                    if($key->keyword == $request->get('search')){
                        $found = true;
                        DB::table('product_searches')->where('keyword', $key->keyword)
                                                    ->update(['rate' => ++$key->rate]);
                    }
                }
                if($found == false){
                    $newKeyword = new ProductSearch([
                        "keyword" => $request->get('search'),
                        "rate" => 1
                    ]);
                    $newKeyword->save();
                }
            }
            else{
                $newKeyword = new ProductSearch([
                    "keyword" => $request->get('search'),
                    "rate" => 1
                ]);
                $newKeyword->save();
            }
            $keyword = "%".$request->get('search')."%";
            $searchMerchant = DB::table('merchants')->where('merchantName', 'LIKE', $keyword)->get();
            $query->where('productName', 'LIKE', $keyword);
        }

        if($request->get('sort')=="popular"){
            $query->orderBy('popularity', 'desc');
        }
        else if($request->get('sort')=="latest"){
            $query->latest();
        }
        else if($request->get('sort')=="sales"){
            $query->orderBy('productSold', 'desc');
        }

        if($request->get('price')=="asc"){
            $query->orderBy('productPrice', 'asc');
        }
        else if($request->get('price')=="dsc"){
            $query->orderBy('productPrice', 'desc');
        }

        if($request->get('min') != null){
            $query->where('productPrice', '>=', $request->get('min'));
        }

        if($request->get('max') != null){
            $query->where('productPrice', '<=', $request->get('max'));
        }

        $products = $query->join('product_images', 'products.id', '=', 'product_images.productID')->select('products.*', 'product_images.image1')->paginate(30);
        return view('product')->with('products', $products)
                                ->with('keyword', $request->get('search'))
                                ->with('sort', $request->get('sort'))
                                ->with('price', $request->get('price'))
                                ->with('min', $request->get('min'))
                                ->with('max', $request->get('max'))
                                ->with('searchMerchant', $searchMerchant);
    }

    public function show($id){
        $product = DB::table('products')->where('products.id', '=', $id)
                                        ->join('product_images', 'products.id', '=', 'product_images.productID')
                                        ->join('merchants', 'products.merchantEmail', '=', 'merchants.email')
                                        ->select('products.*', 'product_images.*', 'merchants.id')
                                        ->get();
        DB::table('products')->where('products.id', '=', $id)
                            ->update(['popularity' => ++$product[0]->popularity]);
        $popularCat = PopularCategories::all();
        foreach($popularCat as $pC){
            if($pC->category == $product[0]->category){
                DB::table('popular_categories')->where('category', $pC->category)
                                            ->update(['popularity' => ++$pC->popularity]);
            }
        }

        return view('productDetail', ['product' => $product]);
    }
}

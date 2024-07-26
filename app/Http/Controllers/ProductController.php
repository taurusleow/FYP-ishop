<?php

namespace App\Http\Controllers;

use App\Models\ProductAuthentications;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $merchant = Auth::user();
        $products = DB::table('products')->where('merchantEmail', '=', $merchant->email)
                                        ->join('product_images', 'products.id', '=', 'product_images.productID')
                                        ->paginate(10);

        return view('merchantProducts', ['products' => $products]);
    }

    public function show($id){
        $product = DB::table('products')->where('products.id', '=', $id)->join('product_images', 'products.id', '=', 'product_images.productID')->get();
        $productincart = DB::table('cart_items')->where('cart_items.productID', $id)
                                                ->join('carts', 'carts.id', '=', 'cart_items.cartID')
                                                ->where('carts.status' , 'Cart')->get();
        $total = 0;
        foreach($productincart as $productCart){
            $total += $productCart->quantity;
        }
        $addedtocart = $total;

        return view('merchantViewProduct')
                    ->with('id', $id)
                    ->with('product', $product)
                    ->with('addedtocart', $addedtocart);
    }

    public function create(){
        return view('merchantAddProduct');
    }

    public function edit($id){
        $product = DB::table('products')->where('products.id', '=', $id)
                    ->join('product_images', 'products.id', '=', 'product_images.productID')
                    ->get();
        $variant = DB::table('product_variants')->where('productID', $id)->get();
        return view('merchantEditProduct')
                    ->with('id', $id)
                    ->with('product', $product)
                    ->with('variant', $variant);
    }

    public function update(Request $request, $id){
        $request->validate([
            'productname' => 'required|min:5|max:100',
            'productDescription' => 'required|min:10|max:65535',
            'price' => 'required|numeric|max:10000000',
            'stock' => 'required|numeric|max:10000000',
            'image1' => 'mimes:jpeg,bmp,png,jpg',
            'image2' => 'mimes:jpeg,bmp,png,jpg',
            'image3' => 'mimes:jpeg,bmp,png,jpg',
            'image4' => 'mimes:jpeg,bmp,png,jpg',
            'image5' => 'mimes:jpeg,bmp,png,jpg',
            'image6' => 'mimes:jpeg,bmp,png,jpg',
            'image7' => 'mimes:jpeg,bmp,png,jpg',
            'image8' => 'mimes:jpeg,bmp,png,jpg',
            'image9' => 'mimes:jpeg,bmp,png,jpg',
            'document' => 'mimes:pdf',
        ]);

        $document = null;
        $status = "no";

        $getProductImages = DB::table('product_images')->where('productID', $id)->get();
        $getProductAuthenticate = DB::table('product_authentications')->where('productID', $id)->get();
        $fileName = null;
        $fileName2 = null;
        $fileName3 = null;
        $fileName4 = null;
        $fileName5 = null;
        $fileName6 = null;
        $fileName7 = null;
        $fileName8 = null;
        $fileName9 = null;

        if($getProductImages[0]->image1!=null){
            $fileName = $getProductImages[0]->image1;
        }
        if($getProductImages[0]->image2!=null){
            $fileName2 = $getProductImages[0]->image2;
        }
        if($getProductImages[0]->image3!=null){
            $fileName3 = $getProductImages[0]->image3;
        }
        if($getProductImages[0]->image4!=null){
            $fileName4 = $getProductImages[0]->image4;
        }
        if($getProductImages[0]->image5!=null){
            $fileName5 = $getProductImages[0]->image5;
        }
        if($getProductImages[0]->image6!=null){
            $fileName6 = $getProductImages[0]->image6;
        }
        if($getProductImages[0]->image7!=null){
            $fileName7 = $getProductImages[0]->image7;
        }
        if($getProductImages[0]->image8!=null){
            $fileName8 = $getProductImages[0]->image8;
        }
        if($getProductImages[0]->image9!=null){
            $fileName9 = $getProductImages[0]->image9;
        }
        if($getProductAuthenticate[0]->fileName!=null){
            $document = $getProductAuthenticate[0]->fileName;
        }

        if($request->file('image1')!= null){
            $fileName1 = $request->file('image1')->hashName();
            $request->file('image1')->move(public_path('productImg'), $fileName1);
        }

        if($request->file('document')!= null){
            $document = $request->file('document')->hashName();
            $request->file('document')->move(public_path('productAuthenticate'), $document);
            $status = "pending";
        }

        if($request->file('image2')!= null){
            $fileName2 = $request->file('image2')->hashName();
            $request->file('image2')->move(public_path('productImg'), $fileName2);
        }
        if($request->file('image3')!= null){
            $fileName3 = $request->file('image3')->hashName();
            $request->file('image3')->move(public_path('productImg'), $fileName3);
        }
        if($request->file('image4')!= null){
            $fileName4 = $request->file('image4')->hashName();
            $request->file('image4')->move(public_path('productImg'), $fileName4);
        }
        if($request->file('image5')!= null){
            $fileName5 = $request->file('image5')->hashName();
            $request->file('image5')->move(public_path('productImg'), $fileName5);
        }
        if($request->file('image6')!= null){
            $fileName6 = $request->file('image6')->hashName();
            $request->file('image6')->move(public_path('productImg'), $fileName6);
        }
        if($request->file('image7')!= null){
            $fileName7 = $request->file('image7')->hashName();
            $request->file('image7')->move(public_path('productImg'), $fileName7);
        }
        if($request->file('image8')!= null){
            $fileName8 = $request->file('image8')->hashName();
            $request->file('image8')->move(public_path('productImg'), $fileName8);
        }
        if($request->file('image9')!= null){
            $fileName9 = $request->file('image9')->hashName();
            $request->file('image9')->move(public_path('productImg'), $fileName9);
        }

        $product = Product::findOrFail($id);
        $product->category = $request->get('category');
        $product->productName = $request->get('productname');
        $product->productDesc = $request->get('productDescription');
        $product->productPrice = $request->get('price');
        $product->productStock = $request->get('stock');
        $product->save();

        DB::table('product_images')->where('productID', $id)->update(['image1' => $fileName,
                                                                    'image2' => $fileName2,
                                                                    'image3' => $fileName3,
                                                                    'image4' => $fileName4,
                                                                    'image5' => $fileName5,
                                                                    'image6' => $fileName6,
                                                                    'image7' => $fileName7,
                                                                    'image8' => $fileName8,
                                                                    'image9' => $fileName9,]);


        DB::table('product_authentications')->where('productID', $id)
                                            ->update(['fileName' => $document, 'status' => "pending"]);

        return redirect('/merchantProducts');
    }

    public function store(Request $request)
    {
        $request->validate([
            'productname' => 'required|min:5|max:100',
            'productDescription' => 'required|min:10|max:65535',
            'price' => 'required|numeric|max:10000000',
            'stock' => 'required|numeric|max:10000000',
            'image1' => 'required|mimes:jpeg,bmp,png,jpg',
            'image2' => 'mimes:jpeg,bmp,png,jpg',
            'image3' => 'mimes:jpeg,bmp,png,jpg',
            'image4' => 'mimes:jpeg,bmp,png,jpg',
            'image5' => 'mimes:jpeg,bmp,png,jpg',
            'image6' => 'mimes:jpeg,bmp,png,jpg',
            'image7' => 'mimes:jpeg,bmp,png,jpg',
            'image8' => 'mimes:jpeg,bmp,png,jpg',
            'image9' => 'mimes:jpeg,bmp,png,jpg',
            'document' => 'mimes:pdf',
        ]);

        $document = null;
        $status = "no";

        $fileName2 = null;
        $fileName3 = null;
        $fileName4 = null;
        $fileName5 = null;
        $fileName6 = null;
        $fileName7 = null;
        $fileName8 = null;
        $fileName9 = null;

        $fileName1 = $request->file('image1')->hashName();
        $request->file('image1')->move(public_path('productImg'), $fileName1);

        if($request->file('document')!= null){
            $document = $request->file('document')->hashName();
            $request->file('document')->move(public_path('productAuthenticate'), $document);
            $status = "pending";
        }

        if($request->file('image2')!= null){
            $fileName2 = $request->file('image2')->hashName();
            $request->file('image2')->move(public_path('productImg'), $fileName2);
        }
        if($request->file('image3')!= null){
            $fileName3 = $request->file('image3')->hashName();
            $request->file('image3')->move(public_path('productImg'), $fileName3);
        }
        if($request->file('image4')!= null){
            $fileName4 = $request->file('image4')->hashName();
            $request->file('image4')->move(public_path('productImg'), $fileName4);
        }
        if($request->file('image5')!= null){
            $fileName5 = $request->file('image5')->hashName();
            $request->file('image5')->move(public_path('productImg'), $fileName5);
        }
        if($request->file('image6')!= null){
            $fileName6 = $request->file('image6')->hashName();
            $request->file('image6')->move(public_path('productImg'), $fileName6);
        }
        if($request->file('image7')!= null){
            $fileName7 = $request->file('image7')->hashName();
            $request->file('image7')->move(public_path('productImg'), $fileName7);
        }
        if($request->file('image8')!= null){
            $fileName8 = $request->file('image8')->hashName();
            $request->file('image8')->move(public_path('productImg'), $fileName8);
        }
        if($request->file('image9')!= null){
            $fileName9 = $request->file('image9')->hashName();
            $request->file('image9')->move(public_path('productImg'), $fileName9);
        }

        $merchant = Auth::user();
        $product = new Product([
            "merchantEmail" => $merchant->email,
            "category" => $request->get('category'),
            "productName" => $request->get('productname'),
            "productDesc" => $request->get('productDescription'),
            "productPrice" => $request->get('price'),
            "productStock" => $request->get('stock'),
            "productSold" => 0,
            "authentication" => 0,
            "status" => "up",
            "popularity" => 0
        ]);

        if($product->save()){
            $productImg = new ProductImages([
                "productID" => $product->id,
                "image1" => $fileName1,
                "image2" => $fileName2,
                "image3" => $fileName3,
                "image4" => $fileName4,
                "image5" => $fileName5,
                "image6" => $fileName6,
                "image7" => $fileName7,
                "image8" => $fileName8,
                "image9" => $fileName9,
            ]);

            $productAuthentication = new ProductAuthentications([
                "productID" => $product->id,
                "fileName" => $document,
                "status" => $status,
            ]);

            $productImg->save();
            $productAuthentication->save();
        }

        return redirect('/merchantProducts');
    }
}

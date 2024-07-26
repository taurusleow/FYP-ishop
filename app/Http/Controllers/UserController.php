<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\MerchantAuthentications;
use App\Models\ProductRecommends;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();

        return view('userProfile', ['userprofile' => $userprofile], ['customerprofile' => $customerprofile]);
    }

    public function update(Request $request){
        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'image' => 'mimes:jpeg,bmp,png,jpg',
            'phoneNo' => 'required|min:8|max:12',
        ]);

        $user = User::findOrFail($request->get('userid'));
        $customer = Customer::findOrFail($request->get('customerid'));

        $fileName = null;
        if($request->file('image')!= null){
            $fileName = $request->file('image')->hashName();
            $request->file('image')->move(public_path('customerImg'), $fileName);
        }

        $user->firstName = $request->get('firstname');
        $user->lastName = $request->get('lastname');
        $user->phoneNo = $request->get('phoneNo');
        $customer->customerImg = $fileName;
        $customer->customerCountry = $request->get('country');
        $customer->customerState = $request->get('state');

        $user->save();
        $customer->save();

        return redirect('/profile');
    }

    public function store(Request $request)
    {
        if($request->get('userType') != null){
            if($request->get('userType') == "customer"){
                $request->validate([
                    'firstname' => 'required|max:100',
                    'lastname' => 'required|max:100',
                    'email' => 'required|unique:users|max:255',
                    'image' => 'mimes:jpeg,bmp,png,jpg',
                    'phoneNo' => 'required|min:8|max:12',
                    'password' => ['required', 'confirmed', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
                ]);

                $fileName = null;
                if($request->file('image')!= null){
                    $fileName = $request->file('image')->hashName();
                    $request->file('image')->move(public_path('customerImg'), $fileName);
                }

                $hashPassword = Hash::make($request->get('password'));

                $user = new User([
                    "firstName" => $request->get('firstname'),
                    "lastName" => $request->get('lastname'),
                    "email" => $request->get('email'),
                    "phoneNo" => $request->get('phoneNo'),
                    "password" => $hashPassword,
                    "type" => "customer"
                ]);

                $customer = new Customer([
                    "email" => $request->get('email'),
                    "customerImg" => $fileName,
                    "customerType" => "basic",
                    "customerCountry" => $request->get('country'),
                    "customerState" => $request->get('state'),
                    "customerStatus" => "up"
                ]);



                $user->save();

                if($customer->save()){
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Appliances",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();

                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Apps & Games",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Arts, Crafts, & Sewing",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Automotive Parts & Accessories",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Baby",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Beauty & Personal Care",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Books",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "CDs & Vinyl",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Cell Phones & Accessories",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Clothing, Shoes and Jewelry",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Collectibles & Fine Art",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Computers",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Electronics",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Garden & Outdoor",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Grocery & Gourmet Food",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Handmade",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Health, Household & Baby Care",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Home & Kitchen",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Industrial & Scientific",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Kindle",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Luggage & Travel Gear",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Movies & TV",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Musical Instruments",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Office Products",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Pet Supplies",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Sports & Outdoors",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Tools & Home Improvement",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Toys & Games",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $customerProdRec = new ProductRecommends([
                        "customerEmail" => $request->get('email'),
                        "productCategory" => "Video Games",
                        "rate" => 2
                    ]);
                    $customerProdRec->save();
                    $newWallet = new Wallet([
                        "customerID" => $customer->id,
                        "customerEmail" => $request->get('email'),
                        "balance" => 0
                    ]);
                    $newWallet->save();
                }

                return view('auth.login');
            }
            else if($request->get('userType') == "merchant"){
                $request->validate([
                    'firstname' => 'required|max:100',
                    'lastname' => 'required|max:100',
                    'email' => 'required|unique:users|max:255',
                    'image' => 'mimes:jpeg,bmp,png,jpg',
                    'storename' => 'required|max:50',
                    'storeDescription' => 'required|min:1|max:255',
                    'phoneNo' => 'required|min:8|max:12',
                    'password' => ['required', 'confirmed', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
                ]);

                $fileName = null;
                if($request->file('image')!= null){
                    $fileName = $request->file('image')->hashName();
                    $request->file('image')->move(public_path('merchantImg'), $fileName);
                }

                $hashPassword = Hash::make($request->get('password'));

                $user = new User([
                    "firstName" => $request->get('firstname'),
                    "lastName" => $request->get('lastname'),
                    "email" => $request->get('email'),
                    "phoneNo" => $request->get('phoneNo'),
                    "password" => $hashPassword,
                    "type" => "merchant"
                ]);

                $merchant = new Merchant([
                    "email" => $request->get('email'),
                    "merchantName" => $request->get('storename'),
                    "merchantCategory" => $request->get('category'),
                    "merchantImg" => $fileName,
                    "authorisedMerchant" => 0,
                    "merchantCountry" => $request->get('country'),
                    "merchantState" => $request->get('state'),
                    "merchantDesc" => $request->get('storeDescription'),
                    "merchantStatus" => "up"
                ]);

                $user->save();
                if($merchant->save()){
                    $merchantAuthenticate = new MerchantAuthentications([
                        "merchantID" => $merchant->id,
                        "fileName" => null,
                        "status" => "no"
                    ]);
                    $merchantAuthenticate->save();
                }

                return view('auth.login');
            }
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProductRecommends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductRecommendController extends Controller
{
    public function index(){
        $user = Auth::user();
        $prodRec = DB::table('product_recommends')->where('customerEmail', '=', $user->email)->get();

        return view('userShoppingPreferences', ['prodRec' => $prodRec]);
    }

    public function update(Request $request){
        $user = Auth::user();

        $prodRec = DB::table('product_recommends')->where('customerEmail', '=', $user->email)->get();
        foreach($prodRec as $rec){
            for($i=1; $i<=sizeof($prodRec);$i++){
                if($rec->productCategory == $request->get('name'.$i)){
                    DB::table('product_recommends')->where('id', $rec->id)->update(['rate' => $request->get('range'.$i)]);
                }
            }
        }

        return redirect('/prodRec');
    }
}

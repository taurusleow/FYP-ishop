<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index(){
        $user = Auth::user();

        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();
        $addresses = DB::table('addresses')->where('customerEmail', '=', $user->email)->paginate(10);

        return view('userAddressBook')->with('addresses', $addresses)
                                        ->with('userprofile', $userprofile)
                                        ->with('customerprofile', $customerprofile);
    }

    public function create(){
        $user = Auth::user();
        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();

        return view('userAddAddress')->with('userprofile', $userprofile)
                                    ->with('customerprofile', $customerprofile);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:30',
            'addressNo' => 'required|max:50',
            'address1' => 'required|max:50',
            'address2' => 'max:50',
            'address3' => 'max:50',
            'poscode' => 'required|min:5|max:5',
        ]);
        $user = Auth::user();
        $address = new Address([
            "customerEmail" => $user->email,
            "addressName" => $request->get('name'),
            "addressNo" => $request->get('addressNo'),
            "addressOne" => $request->get('address1'),
            "addressTwo" => $request->get('address2'),
            "addressThree" => $request->get('address3'),
            "poscode" => $request->get('poscode'),
            "country" => $request->get('country'),
            "state" => $request->get('state')
        ]);

        $address->save();
        return redirect('/userAddress');
    }

    public function edit($id){
        $address = Address::findOrFail($id);
        $user = Auth::user();
        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();

        return view('userEditAddress')->with('id', $id)
                                        ->with('address', $address)
                                        ->with('userprofile', $userprofile)
                                        ->with('customerprofile', $customerprofile);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|max:30',
            'addressNo' => 'required|max:50',
            'address1' => 'required|max:50',
            'address2' => 'max:50',
            'address3' => 'max:50',
            'poscode' => 'required|min:5|max:5',
        ]);

        $address = Address::findOrFail($request->get('addressId'));

        $address->addressName = $request->get('name');
        $address->addressNo = $request->get('addressNo');
        $address->addressOne = $request->get('address1');
        $address->addressTwo = $request->get('address2');
        $address->addressThree = $request->get('address3');
        $address->poscode = $request->get('poscode');
        $address->state = $request->get('state');
        $address->country = $request->get('country');

        $address->save();

        return redirect('/userAddress');
    }
}

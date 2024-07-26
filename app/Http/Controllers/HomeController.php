<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->type == "customer"){
            return view('home');
        }
        else if($user->type == "merchant"){
            return redirect('/dashboard');
        }
        else if($user->type == "admin"){
            return redirect('/adminDashboard');
        }
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\PayMethodController;
use App\Http\Controllers\CustProductController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\MerchantOrderController;
use App\Http\Controllers\ReturnAndRefundController;
use App\Http\Controllers\ProductRecommendController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('users', 'App\Http\Controllers\UserController');
Route::resource('products', 'App\Http\Controllers\ProductController');
Route::resource('product', 'App\Http\Controllers\CustProductController');
Route::resource('address', 'App\Http\Controllers\AddressController');
Route::resource('paymethod', 'App\Http\Controllers\PayMethodController');
Route::resource('prodRec', 'App\Http\Controllers\ProductRecommendController');
Route::resource('admin', 'App\Http\Controllers\AdminController');
Route::resource('cart', CartController::class);
Route::resource('cartItems', CartItemsController::class);
Route::resource('voucher', VoucherController::class);
Route::resource('order', OrderController::class);
Route::resource('orderDetails', OrderDetailsController::class);
Route::resource('payment', PaymentController::class);

Route::get('/', function () {
    return view('home');
});
Route::get('/userRegister', function () {
    return view('userRegister');
});
Route::get('/merchantRegister', function () {
    return view('merchantRegister');
});
//Route: Kuai Cheng Keat
//Merchant side route
Route::get('/dashboard', [MerchantController::class, 'index'])->middleware('auth');
Route::get('/merchantProducts', [ProductController::class, 'index'])->middleware('auth');
Route::get('/merchantProducts/{id}', [ProductController::class, 'show'])->middleware('auth');
Route::get('/merchantProducts/create', [ProductController::class, 'create'])->middleware('auth');
Route::get('/merchantEditProducts/{id}', [ProductController::class, 'edit'])->middleware('auth');
Route::post('/merchantEditProducts/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::get('/merchantProfile', [MerchantController::class, 'profile'])->middleware('auth');
Route::post('/merchantEditProfile', [MerchantController::class, 'update'])->middleware('auth');
Route::get('/merchantReports', function () {
    return view('merchantReports');
});
Route::get('/merchantAddProduct', function () {
    return view('merchantAddProduct');
});
Route::get('/merchantSalesReport', [MerchantController::class, 'report'])->middleware('auth');

//Customer side route: work without login
Route::get('/product', [CustProductController::class, 'index']);
Route::get('/productCat', [CustProductController::class, 'prodCat']);
Route::get('/product/{id}', [CustProductController::class, 'show']);
Route::get('/productSearch', [CustProductController::class, 'search']);
Route::get('/merchantStore/{id}', [CustProductController::class, 'merchantStore']);

//Customer side route: work with login
Route::get('/profile', [UserController::class, 'index'])->middleware('auth');
Route::post('/editProfile', [UserController::class, 'update'])->middleware('auth');

Route::get('/userAddress', [AddressController::class, 'index'])->middleware('auth');
Route::get('/userAddress/create', [AddressController::class, 'create'])->middleware('auth');
Route::get('/userAddress/{id}', [AddressController::class, 'edit'])->middleware('auth');
Route::post('/userAddress/{id}', [AddressCOntroller::class, 'update'])->middleware('auth');

Route::get('/payMethod', [PayMethodController::class, 'index'])->middleware('auth');
Route::get('/payMethod/create', [PayMethodController::class, 'create'])->middleware('auth');
Route::get('/payMethod/{id}', [PayMethodController::class, 'edit'])->middleware('auth');
Route::post('/payMethod/{id}', [PayMethodController::class, 'update'])->middleware('auth');

Route::get('/prodRec', [ProductRecommendController::class, 'index']);
Route::post('/prodRec/update', [ProductRecommendController::class, 'update']);

Route::get('/prodRec', [ProductRecommendController::class, 'index'])->middleware('auth');
Route::post('/prodRec/update', [ProductRecommendController::class, 'update'])->middleware('auth');

//Admin side route
Route::get('/adminDashboard', [AdminController::class, 'index'])->middleware('auth');

Route::get('/authMerchant', [AdminController::class, 'authMerchant'])->middleware('auth');
Route::get('/authProduct', [AdminController::class, 'authProduct'])->middleware('auth');

Route::get('/approveProduct/{id}', [AdminController::class, 'approve'])->middleware('auth');
Route::get('/declineProduct/{id}', [AdminController::class, 'decline'])->middleware('auth');

Route::get('/approveMerchant/{id}', [AdminController::class, 'approveM'])->middleware('auth');
Route::get('/declineMerchant/{id}', [AdminController::class, 'declineM'])->middleware('auth');

Route::get('/adminReports', [AdminController::class, 'report'])->middleware('auth');
Route::get('/adminVouchers', [VoucherController::class, 'index'])->middleware('auth');
Route::get('/adminAddVoucher', [VoucherController::class, 'create'])->middleware('auth');
Route::get('/adminEditVoucher/{id}', [VoucherController::class, 'edit'])->middleware('auth');
Route::post('/adminEditVoucher/{id}', [VoucherController::class, 'update'])->middleware('auth');
//End of Route: Kuai Cheng Keat

// Leow Soon Kuan routes
Route::get('/merchantOrders', [MerchantOrderController::class, 'index']);
Route::get('/merchantEditOrder/{id}', [MerchantOrderController::class, 'orderStatus']);
Route::post('/merchantEditOrder/{id}', [MerchantOrderController::class, 'update']);

Route::get('/merchantRefundRequest', [MerchantOrderController::class, 'showRefund']);
Route::get('/merchantViewRequest/{id}', [MerchantOrderController::class, 'viewRequest']);
Route::post('/merchantViewRequest/{id}', [MerchantOrderController::class, 'updateRequest']);

Route::get('/deliveryReport', [ReportController::class, 'delivery']);
Route::get('/refundReport', [ReportController::class, 'refund']);
Route::get('/salesReport', [ReportController::class, 'sales']);

Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/create', [CartController::class, 'create']);
Route::get('/cartEdit/{id}', [CartController::class, 'edit']);
Route::get('/cart/{id}/del', [CartController::class, 'destroy']);

Route::get('/orderConfirmation', [PaymentController::class, 'index']);
Route::get('/payment', [OrderController::class, 'index']);
Route::post('charge', [OrderController::class, 'charge']);
Route::get('success', [OrderController::class, 'success']);
Route::get('error', [OrderController::class, 'error']);

Route::get('/userTopUpWallet', [PayMethodController::class, 'showTopUpForm']);
Route::post('/userTopUpWallet/charge', [PayMethodController::class, 'topUpCharge']);
Route::get('/userTopUpWallet/success', [PayMethodController::class, 'topUpSuccess']);
Route::get('/userTopUpWallet/error', [PayMethodController::class, 'topUpError']);

Route::get('/userOrderStatus', [OrderDetailsController::class, 'index']);
Route::get('/userViewOrder/{id}', [OrderController::class, 'viewOrder']);
Route::get('/userEditOrderAddress/{id}', [OrderController::class, 'editAddress']);

Route::get('/userOrderHistory', [OrderDetailsController::class, 'showHistory']);
Route::get('/userAcceptOrder/{id}', [OrderController::class, 'showOrder']);
Route::get('/returnandrefund/{id}', [OrderController::class, 'returnRequest']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

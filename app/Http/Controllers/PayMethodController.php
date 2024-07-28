<?php

namespace App\Http\Controllers;

use Omnipay\Omnipay;
use App\Models\PayPal;
use App\Models\PayMethod;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayMethodController extends Controller
{
    /**
     * 
     * @author Leow Soon Kuan <showTopUpForm, topUpCharges, topUpSuccess, topUpError>
     *
     */

    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function index(){
        $user = Auth::user();
        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();
        $paymethods = DB::table('pay_methods')->where('customerEmail', '=', $user->email)->paginate(10);

        $wallet = DB::table('wallets')
                    ->select('*')
                    ->where('customerEmail', '=', $user->email)
                    ->latest()->first();

        return view('userPaymentMethod', ['paymethods' => $paymethods])
            ->with('wallets', $wallet)->with('paymethods', $paymethods)
                                        ->with('userprofile', $userprofile)
                                        ->with('customerprofile', $customerprofile);
    }

    public function showTopUpForm(){
        $user = Auth::user();

        $wallet = DB::table('wallets')
                    ->select('*')
                    ->where('customerEmail', '=', $user->email)
                    ->latest()->first();

        return view('userTopUpWallet')->with('wallets', $wallet);
    }

    public function create(){
        $user = Auth::user();
        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();
        return view('userAddPayment')->with('userprofile', $userprofile)
                                        ->with('customerprofile', $customerprofile);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:30',
            'cardno' => 'required|numeric',
            'cvv' => 'required|numeric',
        ]);
        $user = Auth::user();
        $payMethod = new PayMethod([
            "customerEmail" => $user->email,
            "paymentName" => $request->get('name'),
            "paymentType" => $request->get('type'),
            "paymentCompany" => $request->get('company'),
            "cardNo" => $request->get('cardno'),
            "cardMExpiry" => $request->get('expiryM'),
            "cardYExpiry" => $request->get('expiryY'),
            "cardCVV" => $request->get('cvv'),
        ]);

        $payMethod->save();
        return redirect('/payMethod');
    }

    public function edit($id){
        $payMethod = PayMethod::findOrFail($id);
        $user = Auth::user();
        $userprofile = User::findOrFail($user->id);
        $customerprofile = DB::table('customers')->where('email', $user->email)->get();

        return view('userEditPayment')->with('userprofile', $userprofile)
                                        ->with('customerprofile', $customerprofile)
                                        ->with('id', $id)
                                        ->with('payMethod', $payMethod);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:30',
            'cardno' => 'required|numeric',
            'cvv' => 'required|numeric',
        ]);

        $payMethod = PayMethod::findOrFail($id);

        $payMethod->paymentName = $request->get('name');
        $payMethod->paymentType = $request->get('type');
        $payMethod->paymentCompany = $request->get('company');
        $payMethod->cardNo = $request->get('cardno');
        $payMethod->cardMExpiry = $request->get('expiryM');
        $payMethod->cardYExpiry = $request->get('expiryY');

        $payMethod->save();

        return redirect('/payMethod');
    }

    public function topUpCharge(Request $request){
        if(isset($_POST['submit']))
        {
            $user = Auth::user();

            $wallet = DB::table('wallets')
                    ->select('*')
                    ->where('customerEmail', '=', $user->email)
                    ->latest()->first();

            $topUpAmount = $request->get('topUpAmount');

            $newBalance = $wallet->balance + $topUpAmount;

            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->get('topUpAmount'),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('/userTopUpWallet/success'),
                    'cancelUrl' => url('/userTopUpWallet/error'),
                ))->send();

                if ($response->isRedirect()) {
                    $updateWallet = DB::table('wallets')
                                    ->where('customerEmail', $user->email)
                                    ->update(['balance' => $newBalance,
                                    'updated_at' => date("Y-m-d h:i:s")]);

                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function topUpSuccess(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $payment = new PayPal();
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();

                echo "<script>alert('Top Up is successful. Check your balance in Payment Method!')</script>";

                return redirect('/payMethod');
            } else {
                return $response->getMessage();
            }
        } else {
            echo "<script>alert('Transaction is declined. Please do the payment again!')</script>";

            return redirect('/payMethod');
        }
    }

    public function topUpError()
    {
        echo "<script>alert('You have cancelled the payment.')</script>";

        return redirect('/payMethod');
    }
}

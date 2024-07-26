@extends('layout.homeLayout')

@section('content')

<style>
    input::-webkit-outer-spin-button,input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    td {
        padding-left: 5px;
        padding-top: 5px;
        padding-bottom: 10px;
        padding-right: 5px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#selectMethod").change(function () {
            $(this).find("option:selected").each(function () {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".box").hide();
                }
            });
        }).change();
    });
</script>

<div style="margin-top: 80px; margin-left: 100px;">
    <div>
        <h2>Payment</h2>
    </div>

    <div style="width: 30%; margin-right: auto; margin-left:auto;">
        <h3>Select Delivery Method</h3>

        <form action="" method="GET">
            <select class="form-select" name="deliveryMethod" aria-label="Default select example">
                <option value="delivery">Delivery</option>
                <option value="pickUp">Pick Up</option>
            </select>

            <br>

            <button type="submit" name="confirm" class="btn btn-primary" style="float: right;">Confirm</button>
        </form>

        <br><br>

        @if(isset($_GET['confirm']))
            @if($_GET['deliveryMethod'] == "pickUp")
                <form action = "{{url('order')}}" method="POST">
                    @csrf
                    <table class="table table-hover">
                        <h3>Pick Up Address</h3>

                        <select class="form-select" name="address" aria-label="Default select example">
                                <option value='Pick Up - 68, Jalan Danau Niaga 1, Crystal Ville, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur'>J&T Express KL- Setapak (KUL007)</option>
                                <option value='Pick Up - The nest, No 01-02, Jln 2/23D, 53300, Wilayah Persekutuan Kuala Lumpur'>J&T Express KL - Genting Klang The Nest (KUL414)</option>
                                <option value='Pick Up - LOT 28261 (LOT C,D,E,F, Jalan Prima Setapak, Taman Setapak, 53000 Kuala Lumpur, Federal Territory of Kuala Lumpur'>J&T KUL303 SETAPAK</option>
                        </select>

                        <br/>

                        <h3>Order Summary</h3>

                        <tbody>
                            <tr>
                                <td><b>Subtotal</b><td>
                                <td>RM {{$carts->subtotal}}</td>
                            </tr>
                            <tr>
                                <td><b>Service Charge (6%)</b><td>
                                <td>RM {{round($carts->subtotal * 0.06, 2)}}</td>
                            </tr>

                            <tr>
                                <td><b>Grand Total</b><td>
                                <td>RM {{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}</td>
                                <input type="hidden" name="total" value="{{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}">
                            </tr>

                        </tbody>
                    </table>

                    <h4>Payment Method</h4>

                    @if(isset($message))
                        @if($message != NULL)
                        <div class="card" style="width: 400px; margin-bottom: 30px; background-color: #ff9a9a;">
                            <div class="card-body">
                                <h5 class="card-title">Input Error</h5>
                                <ul class="card-text">
                                    @foreach($message as $msg)
                                        @if($msg != NULL)
                                        <li>
                                            {{$msg}}
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    @endif

                    <select name="paymentType" id="selectMethod" class="form-select" style="margin-bottom: 10px;">
                        <option value="card">Debit/Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="storeWallet">iShop Wallet</option>
                    </select>

                    <div class="card box">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Card Number</b></td>
                                    <td><input type="number" name="card" placeholder="1234567890123456"></td>
                                    <td><input type="number" name="cvv" min="0" max="999" placeholder="CVV"></td>
                                </tr>

                                <tr>
                                    <td><b>Expire</b></td>
                                    <td>
                                        <select class="form-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="paypal box">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Grand Total: </b></td>
                                    <td>RM <input type="text" name="total" value="{{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}" readonly></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>

                    <div class="storeWallet box">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Grand Total: </b></td>
                                    <td>RM <input type="text" name="total" value="{{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}" readonly></td>
                                </tr>

                                <tr>
                                    <td><b>Wallet Balance: </b></td>
                                    <td>RM <input type="text" name="balance" value="{{$wallets->balance}}" readonly></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success" style="float: right; margin-top: 10px; margin-bottom: 10px;">Pay</button>
                </form>

            @else
                <form action = "{{url('order')}}" method="POST">
                @csrf
                    <table class="table table-hover">

                        <h3>Delivery Address</h3>

                        @if($addresses != NULL)
                        <select class="form-select" name="address" aria-label="Default select example">
                            @foreach($addresses as $a)
                                <option value='Delivery - {{$a->addressName . ", " . "$a->addressNo" . ", " . "$a->addressOne" . ", " . "$a->addressTwo" . ", " . "$a->addressThree" . ", " . $a->poscode . " " . $a->state . "."}}'>
                                    Delivery - {{$a->addressName . ", " . "$a->addressNo" . ", " . "$a->addressOne" . ", " . "$a->addressTwo" . ", " . "$a->addressThree" . ", " . $a->poscode . " " . $a->state . "."}}
                                </option>
                            @endforeach
                        </select>
                        @else
                            <input type="text" name="address" style="width: 400px;" placeholder="eg: No. 8, Jalan Tembikai 8, 12345, Kuala Lumpur" required>
                        @endif

                        <br/>

                        <h3>Order Summary</h3>
                        
                        <tbody>
                            <tr>
                                <td><b>Subtotal</b><td>
                                <td>RM {{$carts->subtotal}}</td>
                            </tr>
                            <tr>
                                <td><b>Service Charge (6%)</b><td>
                                <td>RM {{round($carts->subtotal * 0.06, 2)}}</td>
                            </tr>
                            <tr>
                                <td><b>Grand Total</b><td>
                                <td>RM {{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}</td>
                                <input type="hidden" name="total" value="{{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}">
                            </tr>
                        </tbody>
                    </table>

                    <h4>Payment Method</h4>

                    @if(isset($message))
                        @if($message != NULL)
                        <div class="card" style="width: 400px; margin-bottom: 30px; background-color: #ff9a9a;">
                            <div class="card-body">
                                <h5 class="card-title">Input Error</h5>
                                <ul class="card-text">
                                    @foreach($message as $msg)
                                        @if($msg != NULL)
                                        <li>
                                            {{$msg}}
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    @endif

                    <select name="paymentType" id="selectMethod" class="form-select" style="margin-bottom: 10px;">
                        <option value="card">Debit/Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="storeWallet">iShop Wallet</option>
                    </select>

                    <div class="card box">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Card Number</b></td>
                                    <td><input type="number" name="card" placeholder="1234567890123456"></td>
                                    <td><input type="number" name="cvv" min="0" max="999" placeholder="CVV"></td>
                                </tr>

                                <tr>
                                    <td><b>Expire</b></td>
                                    <td>
                                        <select class="form-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="paypal box">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Grand Total: </b></td>
                                    <td>RM <input type="text" name="total" value="{{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}" readonly></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>

                    <div class="storeWallet box">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Grand Total: </b></td>
                                    <td>RM <input type="text" name="total" value="{{round(($carts->subtotal + $carts->subtotal * 0.06) - ($discountRate * ($carts->subtotal + $carts->subtotal * 0.06)),2)}}" readonly></td>
                                </tr>

                                <tr>
                                    <td><b>Wallet Balance: </b></td>
                                    <td>RM <input type="text" name="balance" value="{{$wallets->balance}}" readonly></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success" style="float: right; margin-top: 10px; margin-bottom: 10px;">Pay</button>
                </form>
            @endif
        @endif
    </div>
</div>

@endsection
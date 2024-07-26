@extends('layout.homeLayout')
@section('content')
    <style>
        .profileLinksContainer {
            width: 100%;
            margin: auto;
            height: auto;
            text-align: center;
        }

        .profileLink {
            color: black;
            width: 16%;
            text-align: center;
            height: 35px;
            line-height: 35px;
            display: inline-block;
            margin: auto;
            transition: .1s;
        }

        .profileLink:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #576649;
        }

        @media screen and (max-width: 1400px) {
            .profileLink {
                width: 100%;
            }
        }
    </style>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="profileLinksContainer">
            <a href="/profile" class="profileLink">My Profile</a>
            <a href="/userAddress" class="profileLink">My Address Book</a>
            <a href="/payMethod" class="profileLink">My Payment Method</a>
            <a href="/prodRec" class="profileLink">My Shopping Preferences</a>
            <a href="/userOrderStatus" class="profileLink">Order Status</a>
            <a href="/userOrderHistory" class="profileLink">Order History</a>
        </div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if (isset($customerprofile[0]->customerImg))
                        <img class="rounded-circle mt-5" width="150px"
                            src="/customerImg/{{ $customerprofile[0]->customerImg }}">
                    @else
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    @endif

                    <span class="font-weight-bold">{{ $userprofile->lastName . ' ' . $userprofile->firstName }}</span>
                    <span class="text-black-50">{{ $customerprofile[0]->email }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Add New Payment Method</h4>
                    </div>
                    <form method="POST" action="{{ route('paymethod.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Give a name to this payment</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="eg: personal account" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Payment Type</label>
                                <select class="form-select" name="type" aria-label="Default select example" required>
                                    <option value="Debit Card / Credit Card" selected>Debit Card / Credit Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Card Number</label>
                                <input type="text" class="form-control @error('cardno') is-invalid @enderror"
                                    placeholder="card number" name="cardno" value="{{ old('cardno') }}">
                                @error('cardno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Payment Company</label>
                                <select class="form-select" name="company" aria-label="Default select example" required>
                                    <option value="Maybank" selected>Maybank</option>
                                    <option value="CIMB Bank">CIMB Bank</option>
                                    <option value="Public Bank">Public Bank</option>
                                    <option value="RHB Bank">RHB Bank</option>
                                    <option value="Hong Leong Bank">Hong Leong Bank</option>
                                    <option value="Ambank">Ambank</option>
                                    <option value="UOB Bank">UOB Bank</option>
                                    <option value="Bank Rakyat">Bank Rakyat</option>
                                    <option value="OCBC Bank">OCBC Bank</option>
                                    <option value="HSBC Bank">HSBC Bank</option>
                                    <option value="Bank Islam">Bank Islam</option>
                                    <option value="Affin Bank">Affin Bank</option>
                                    <option value="Alliance Bank">Alliance Bank</option>
                                    <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                    <option value="MBSB Bank">MBSB Bank</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Expiry (Month)</label>
                                <select class="form-select" name="expiryM" aria-label="Default select example" required>
                                    <option value="1" selected>1</option>
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
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Expiry (Year)</label>
                                <select class="form-select" name="expiryY" aria-label="Default select example" required>
                                    <option value="2022" selected>2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label class="labels">Card CVV</label>
                                <input type="number" min="100" max="999" step="1" class="form-control @error('cvv') is-invalid @enderror"
                                    placeholder="cvv" name="cvv" value="{{ old('cvv') }}">
                                @error('cvv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-success profile-button" type="submit" style="float: right;">Save
                                    Payment Method</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

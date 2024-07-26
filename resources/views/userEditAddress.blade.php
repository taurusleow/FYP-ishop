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
                        <h4 class="text-right">Edit Address</h4>
                    </div>
                    <form method="POST" action="/userAddress/{{ $id }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="addressId" value="{{ $id }}">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Give a name to your address</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="address name" name="name" value="{{ $address->addressName }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Address No.</label>
                                <input type="text" class="form-control @error('addressNo') is-invalid @enderror"
                                    value="{{ $address->addressNo }}" name="addressNo" placeholder="eg: No.35 / Lot3-2">
                                @error('addressNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Address 1</label>
                                <input id="text" type="text"
                                    class="form-control @error('address1') is-invalid @enderror" name="address1"
                                    value="{{ $address->addressOne }}" required autocomplete="email"
                                    placeholder="eg: Jalan xxx / Lorong xxx">
                                @error('address1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address 2</label>
                                <input type="text" class="form-control @error('address2') is-invalid @enderror"
                                    placeholder="Taman xxx (if any)" name="address2" value="{{ $address->addressTwo }}">
                                @error('address2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address 3</label>
                                <input type="text" class="form-control @error('address3') is-invalid @enderror"
                                    placeholder="more details (if any)" name="address3"
                                    value="{{ $address->addressThree }}">
                                @error('address3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="labels">Poscode</label>
                                <input type="text" class="form-control @error('poscode') is-invalid @enderror"
                                    placeholder="eg: 12345" name="poscode" value="{{ $address->poscode }}">
                                @error('poscode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Country</label>
                                <select class="form-select" name="country" aria-label="Default select example" required>
                                    <option value="{{ $address->country }}" selected>--{{ $address->country }}--</option>
                                    <option value="Malaysia">Malaysia</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="labels">State</label>
                                <select class="form-select" name="state" aria-label="Default select example" required>
                                    <option value="{{ $address->state }}" selected>--{{ $address->state }}--</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Labuan">Labuan</option>
                                    <option value="Putrajaya">Putrajaya</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button class="btn btn-success profile-button" type="submit" style="float: right;">Save
                                Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

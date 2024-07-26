@extends('layout.merchantLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if (isset($merchantProfile[0]->merchantImg))
                        <img class="rounded-circle mt-5" width="150px"
                            src="/merchantImg/{{ $merchantProfile[0]->merchantImg }}">
                    @else
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    @endif

                    <span class="font-weight-bold">{{ $userprofile->lastName . ' ' . $userprofile->firstName }}</span>
                    <span class="text-black-50">{{ $merchantProfile[0]->email }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Store's Profile</h4>
                    </div>
                    <form method="POST" action="/merchantEditProfile" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userid" value="{{ $userprofile->id }}">
                        <input type="hidden" name="merchantid" value="{{ $merchantProfile[0]->id }}">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Your Store's Name</label>
                                <input type="text" class="form-control @error('storename') is-invalid @enderror"
                                    placeholder="store name" name="storename"
                                    value="{{ $merchantProfile[0]->merchantName }}">
                                @error('storename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Your Store's Category</label>
                                <select class="form-select" name="category" aria-label="Default select example" required>
                                    <option value="{{ $merchantProfile[0]->merchantCategory }}" selected>
                                        {{ $merchantProfile[0]->merchantCategory }} (Current)</option>
                                    <option value="Appliances">Appliances</option>
                                    <option value="Apps & Games">Apps & Games</option>
                                    <option value="Arts, Crafts, & Sewing">Arts, Crafts, & Sewing</option>
                                    <option value="Automotive Parts & Accessories">Automotive Parts & Accessories
                                    </option>
                                    <option value="Baby">Baby</option>
                                    <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                                    <option value="Books">Books</option>
                                    <option value="CDs & Vinyl">CDs & Vinyl</option>
                                    <option value="Cell Phones & Accessories">Cell Phones & Accessories</option>
                                    <option value="Clothing, Shoes and Jewelry">Clothing, Shoes and Jewelry</option>
                                    <option value="Collectibles & Fine Art">Collectibles & Fine Art</option>
                                    <option value="Computers">Computers</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Garden & Outdoor">Garden & Outdoor</option>
                                    <option value="Grocery & Gourmet Food">Grocery & Gourmet Food</option>
                                    <option value="Handmade">Handmade</option>
                                    <option value="Health, Household & Baby Care">Health, Household & Baby Care
                                    </option>
                                    <option value="Home & Kitchen">Home & Kitchen</option>
                                    <option value="Industrial & Scientific">Industrial & Scientific</option>
                                    <option value="Kindle">Kindle</option>
                                    <option value="Luggage & Travel Gear">Luggage & Travel Gear</option>
                                    <option value="Movies & TV">Movies & TV</option>
                                    <option value="Musical Instruments">Musical Instruments</option>
                                    <option value="Office Products">Office Products</option>
                                    <option value="Pet Supplies">Pet Supplies</option>
                                    <option value="Sports & Outdoors">Sports & Outdoors</option>
                                    <option value="Tools & Home Improvement">Tools & Home Improvement</option>
                                    <option value="Toys & Games">Toys & Games</option>
                                    <option value="Video Games">Video Games</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email Address</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $merchantProfile[0]->email }}" required autocomplete="email"
                                    placeholder="email address" disabled>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Phone Number</label>
                                <input type="text" class="form-control @error('phoneNo') is-invalid @enderror"
                                    placeholder="enter phone number" name="phoneNo" value="{{ $userprofile->phoneNo }}">
                                @error('phoneNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Upload Your Store's Logo/Image(Leave blank if no change)</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Your Store's Description (Max. 255 letters.)</label>
                                <textarea class="form-control @error('storeDescription') is-invalid @enderror" placeholder="store description"
                                    name="storeDescription" style="height: 100px;">{{ $merchantProfile[0]->merchantDesc }}</textarea>
                                @error('storeDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Store's Country</label>
                                <select class="form-select" name="country" aria-label="Default select example" required>
                                    <option value="{{ $merchantProfile[0]->merchantCountry }}" selected>
                                        {{ $merchantProfile[0]->merchantCountry }} (Current)</option>
                                    <option value="Malaysia">Malaysia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Store's State</label>
                                <select class="form-select" name="state" aria-label="Default select example" required>
                                    <option value="{{ $merchantProfile[0]->merchantState }}" selected>
                                        {{ $merchantProfile[0]->merchantState }} (Current)</option>
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
                        @if ($merchantProfile[0]->authorisedMerchant == 0)
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Authorise your store now!(upload supporting document in
                                        pdf)</label>
                                    <input class="form-control @error('imageDocs') is-invalid @enderror" type="file"
                                        name="imageDocs">
                                    @error('imageDocs')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="mt-5">
                            <button class="btn btn-success profile-button" type="submit" style="float: right;">Save
                                Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>I-Shop</title>
    <link rel="icon" type="image/x-icon" href="/images/icon.png">

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/e1608dcd63.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <style>
        body {
            background: linear-gradient(90deg, #b1bea4, #576649);
        }

        #registerFormContainer {
            width: 40%;
        }

        .col-md-12 {
            margin-bottom: 10px;
        }

        .merchant-text {
            color: #727272;
            font-size: 14px;
        }

        .merchant-link {
            text-decoration: none;
            color: #c40000;
            transition: 0.2s;
        }

        .merchant-link:hover {
            color: red;
        }

        @media screen and (max-width: 600px) {
            #registerFormContainer {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5" id="registerFormContainer">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-3">
                        <a href="/">
                            <img class="rounded-circle mt-8" width="300px" src="/images/ishopLogo.png">
                        </a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <h4 class="text-right">Register as Customer</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="merchant-text">Are you Merchant? Please
                            <a href="/merchantRegister" class="merchant-link">Register Here</a>
                        </p>
                    </div>
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userType" value="customer">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Upload Your Profile Picture(Optional)</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                    placeholder="first name" name="firstname" value="{{ old('firstname') }}">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                    value="{{ old('lastname') }}" name="lastname" placeholder="surname">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email Address</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="email address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Phone Number</label>
                                <input type="text" class="form-control @error('phoneNo') is-invalid @enderror"
                                    placeholder="enter phone number" name="phoneNo" value="{{ old('phoneNo') }}">
                                @error('phoneNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Country</label>
                                <select class="form-select" name="country" aria-label="Default select example" required>
                                    <option value="Malaysia" selected>Malaysia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">State</label>
                                <select class="form-select" name="state" aria-label="Default select example" required>
                                    <option value="Kuala Lumpur" selected>Kuala Lumpur</option>
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Password
                                    <p style="font-size: 12px; color: #890000">Must
                                        contain at least <strong>ONE</strong> Uppercase Letter(eg:ABC), lowercase
                                        letter(eg:abc),
                                        Number(eg:123) <strong>AND</strong> Symbol(eg:@#$)
                                    </p>
                                </label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mt-5">
                            <a href="login">
                                <button class="btn btn-primary profile-button" type="button">
                                    < Back</button>
                            </a>
                            <button class="btn btn-success profile-button" type="submit" style="float: right;">Save
                                Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

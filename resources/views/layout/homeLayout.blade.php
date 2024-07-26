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
        a {
            color: #ededed;
            display: inline-block;
            padding: 10px 15px;
            line-height: 1;
            text-decoration: none;
            border-radius: 2px;
            margin-top: 0px;
            padding-top: 0px;
            text-align: center;
        }

        @media only screen and (max-width: 800px) {
            .bar {
                display: none;
            }

            #bar-username {
                display: none;
            }

            #navDropdown {
                display: block;
                float: right;
            }

            #icon {
                color: #ededed;
            }

            #navDropdown:hover {
                background-color: rgba(0, 0, 0, 0.1)
            }
        }
    </style>
</head>

<body class="antialiased">
    <header>
        <div id="headerContainer">
            <a href="/" style="float: left;"><img id="logo" src="/images/ishopLogo.png" alt="Logo"></a>
            <div id="navBar">
                <nav>
                    <a class="bar" href="/product">Product</a>
                    @guest
                        @if (Route::has('login'))
                            <a class="bar" href="{{ route('login') }}">{{ __('Login') }}</a>
                            <a class="text-end" style="position" href="/cart">Cart</a>
                        @endif
                    @else
                        <a id="bar-username" class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->lastName }}
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/profile">Profile</a>
                                <a class="dropdown-item" href="/userOrderStatus">Order Status</a>
                                <a class="dropdown-item" href="/userOrderHistory">Order History</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                        <a class="text-end" style="position" href="/cart">Cart</a>
                    @endguest

                    <div class="dropdown" id="navDropdown">
                        <a class="btn dropdown-toggle" id="icon" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/product">Product</a></li>
                            <li>
                                @guest
                                    @if (Route::has('login'))
                                        <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @endif
                                @else
                                    <a class="dropdown-item" href="/profile">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endguest
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        <div class="footer-clean">
            <footer>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 col-md-3 item">
                            <h3>Products</h3>
                            <ul>
                                <li><a href="#">Appliances</a></li>
                                <li><a href="#">App & Games</a></li>
                                <li><a href="#">Gourmet Food</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-3 item">
                            <h3>About</h3>
                            <ul>
                                <li><a href="#">Company</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Legacy</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-3 item">
                            <h3>Services</h3>
                            <ul>
                                <li><a href="#">Product Order</a></li>
                                <li><a href="#">Product Delivery</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 item social">
                                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-snapchat"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <p class="copyright">I-Shop © 2023</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </footer>

    <script>
        window.onscroll = function() {
            myFunction()
        };

        var header = document.getElementById("headerContainer");
        var myHeader = document.getElementById("navBar");
        var logo = document.getElementById("logo");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
                header.style.height = "60px";
                myHeader.style.height = "60px";
                myHeader.style.lineHeight = "60px";
                logo.style.width = "100px";
                logo.style.height = "50px";
            } else {
                header.classList.remove("sticky");
                header.style.height = "100px";
                myHeader.style.height = "100px";
                myHeader.style.lineHeight = "100px";
                logo.style.width = "180px";
                logo.style.height = "90px";
            }
        }
    </script>
</body>

</html>

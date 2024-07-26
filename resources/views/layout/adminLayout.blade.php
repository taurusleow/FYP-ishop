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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
        integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"
        integrity="sha512-ToRWKKOvhBSS8EtqSflysM/S7v9bB9V0X3B1+E7xo7XZBEZCPL3VX5SFIp8zxY19r7Sz0svqQVbAOx+QcLQSAQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"
        integrity="sha512-s/XK4vYVXTGeUSv4bRPOuxSDmDlTedEpMEcAQk0t/FMd9V6ft8iXdwSBxV0eD60c6w/tjotSlKu9J2AAW1ckTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

</head>
<style>
    .sideNavBar {
        height: 100%;
        width: 70px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #576649;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sideNavBar a {
        padding: 8px 8px 20px 8px;
        text-decoration: none;
        color: #b8b8b8;
        display: block;
        transition: 0.1s;
    }

    .sideNavBar #fontMenu {
        display: none;
        text-align: left;
        font-size: 25px;
    }

    .sideNavBar #iconMenu {
        display: block;
        text-align: center;
        font-size: 25px;
    }

    .sideNavBar a:hover {
        color: #f1f1f1;
    }

    .sideNavBar .closeBtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
        display: none;
    }

    .sideNavBar .openBtn {
        position: absolute;
        left: 12px;
        top: 0;
        font-size: 30px;
        display: block;
    }

    .sideNavBar .logoutBtn {
        position: fixed;
        left: 12px;
        bottom: 0;
        font-size: 25px;
        display: block;
    }

    .sideNavBar .closeBtn:hover {
        color: #ff2727;
    }
</style>

<body class="antialiased">
    <header>
        <div id="sideNavBar" class="sideNavBar">
            <div id="fontMenu">
                <a href="javascript:void(0)" id="closeBtn" class="closeBtn" onclick="closeNavBar()">&times;</a>
                <a href="/authMerchant">Authenticate Merchant</a>
                <a href="/authProduct">Authenticate Product</a>
                <a href="/adminVouchers">Vouchers</a>
                <a href="/adminReports">Reports</a>
            </div>
            <div id="iconMenu">
                <a href="javascript:void(0)" id="openBtn" class="openBtn" onclick="openNavBar()"><i
                        class="fa-solid fa-bars"></i></a>
                <a href="/authMerchant"><i class="fa-solid fa-user"></i></a>
                <a href="/authProduct"><i class="fa-solid fa-box"></i></a>
                <a href="/adminVouchers"><i class="fa-solid fa-percent"></i></a>
                <a href="/adminReports"><i class="fa-solid fa-flag"></i></a>
            </div>
            <a class="logoutBtn" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </header>
    <div class="content" style="margin-left: 80px;">
        @yield('content')
    </div>
    <footer>

    </footer>
    <script>
        function openNavBar() {
            document.getElementById("sideNavBar").style.width = "250px";
            document.getElementById("openBtn").style.display = "none";
            document.getElementById("closeBtn").style.display = "block";
            document.getElementById("iconMenu").style.display = "none";
            document.getElementById("fontMenu").style.display = "block";
        }

        function closeNavBar() {
            document.getElementById("sideNavBar").style.width = "70px";
            document.getElementById("closeBtn").style.display = "none";
            document.getElementById("openBtn").style.display = "block";
            document.getElementById("fontMenu").style.display = "none";
            document.getElementById("iconMenu").style.display = "block";
        }
    </script>
</body>

</html>

@extends('layout.merchantLayout')
@section('content')
    <style>
        .card-wrapper {
            max-width: 1100px;
            margin: 60px auto;
        }

        .card {
            background-color: #fafafa;
            width: 100%;
        }

        img {
            width: 100%;
            display: block;
        }

        .img-display {
            overflow: hidden;
        }

        .img-showcase {
            display: flex;
            width: 100%;
            transition: all 0.5s ease;
        }

        .img-showcase img {
            max-width: 300px;
        }

        .img-select {
            display: flex;
            width: 200px;
        }

        .img-item {
            margin: 0.3rem;
        }

        .img-item:nth-child(1),
        .img-item:nth-child(2),
        .img-item:nth-child(3) {
            margin-right: 0;
        }

        .img-item:hover {
            opacity: 0.8;
        }

        .product-content {
            padding: 2rem 1rem;
        }

        .product-title {
            font-size: 3rem;
            text-transform: capitalize;
            font-weight: 700;
            position: relative;
            color: #12263a;
            margin: 1rem 0;
        }

        .prodSales-title {
            font-size: 3rem;
            text-transform: capitalize;
            font-weight: 700;
            position: relative;
            color: #12263a;
            margin: 1rem 0;
        }

        .prodSales-content-title {
            font-size: 1.5rem;
            text-transform: capitalize;
            font-weight: 700;
            position: relative;
            color: #12263a;
            margin: 1rem 0;
        }

        .product-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 80px;
            background: #12263a;
        }

        .product-link {
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 400;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 0.5rem;
            background: #256eff;
            color: #fff;
            padding: 0 0.3rem;
            transition: all 0.5s ease;
        }

        .product-link:hover {
            opacity: 0.9;
        }

        .product-rating {
            color: #ffc107;
        }

        .product-rating span {
            font-weight: 600;
            color: #252525;
        }

        .product-price {
            margin: 1rem 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .product-price span {
            font-weight: 400;
        }

        .last-price span {
            color: #f64749;
            text-decoration: line-through;
        }

        .new-price span {
            color: #256eff;
        }

        .product-detail h2 {
            text-transform: capitalize;
            color: #12263a;
            padding-bottom: 0.6rem;
        }

        .product-detail p {
            font-size: 0.9rem;
            padding: 0.3rem;
            opacity: 0.8;
        }

        .product-detail ul {
            margin: 1rem 0;
            font-size: 0.9rem;
        }

        .product-detail ul li {
            margin: 0;
            list-style: none;
            background: url(shoes_images/checked.png) left center no-repeat;
            background-size: 18px;
            padding-left: 1.7rem;
            margin: 0.4rem 0;
            font-weight: 600;
            opacity: 0.9;
        }

        .product-detail ul li span {
            font-weight: 400;
        }

        .purchase-info {
            margin: 1.5rem 0;
        }

        .purchase-info input,
        .purchase-info .btn {
            border: 1.5px solid #ddd;
            border-radius: 25px;
            text-align: center;
            padding: 0.45rem 0.8rem;
            outline: 0;
            margin-right: 0.2rem;
            margin-bottom: 1rem;
        }

        .purchase-info input {
            width: 60px;
        }

        .purchase-info .btn {
            cursor: pointer;
            color: #fff;
        }

        .purchase-info .btn:first-of-type {
            background: #256eff;
        }

        .purchase-info .btn:last-of-type {
            background: #f64749;
        }

        .purchase-info .btn:hover {
            opacity: 0.9;
        }

        .social-links {
            display: flex;
            align-items: center;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            color: #000;
            border: 1px solid #000;
            margin: 0 0.2rem;
            border-radius: 50%;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.5s ease;
        }

        .social-links a:hover {
            background: #000;
            border-color: transparent;
            color: #fff;
        }

        .container {
            width: 1100px;
        }

        .displayImg {
            margin: auto;
        }

        .col {
            transition: .1s;
        }

        .col:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .prodSales-content-content {
            font-size: 20px;
        }

        .alert-warning {
            padding: 20px;
            background-color: #ffcc00;
            color: black;
            margin-bottom: 10px;
        }

        .alert-danger {
            padding: 20px;
            background-color: #cc3300;
            color: white;
            margin-bottom: 10px;
        }

        .alert-success {
            padding: 20px;
            background-color: #99cc33;
            color: black;
            margin-bottom: 10px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        @media screen and (min-width: 992px) {
            .card {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 1.5rem;
            }

            .card-wrapper {
                height: auto;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .product-imgs {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .product-content {
                padding-top: 0;
            }
        }

        @media screen and (max-width: 991px) {
            .card-wrapper {
                margin: 0px auto;
            }

            .displayImg {
                display: none;
            }

            .container {
                width: 100%;
            }
        }
    </style>
    @if ($addedtocart > $product[0]->productStock)
        <div style="width:77%; margin:auto; margin-top: 50px;">
            <div class="alert-warning">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Suggestion!</strong> Suggest to increase product stock to  at least <strong>{{$addedtocart}}</strong> as your product currently in high demand!
            </div>
        </div>
    @endif
    <div class="card-wrapper">
        <div class="card">
            <!-- card left -->
            <div class="product-imgs">
                <div class="img-display">
                    <div class="img-showcase">
                        <img src="/productImg/{{ $product[0]->image1 }}" max-width="100px" alt="Product image">
                        @if ($product[0]->image2 != null)
                            <img src="/productImg/{{ $product[0]->image2 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image3 != null)
                            <img src="/productImg/{{ $product[0]->image3 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image4 != null)
                            <img src="/productImg/{{ $product[0]->image4 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image5 != null)
                            <img src="/productImg/{{ $product[0]->image5 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image6 != null)
                            <img src="/productImg/{{ $product[0]->image6 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image7 != null)
                            <img src="/productImg/{{ $product[0]->image7 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image8 != null)
                            <img src="/productImg/{{ $product[0]->image8 }}" max-width="100px" alt="Product image">
                        @endif
                        @if ($product[0]->image9 != null)
                            <img src="/productImg/{{ $product[0]->image9 }}" max-width="100px" alt="Product image">
                        @endif
                    </div>
                </div>
                <div class="img-select">
                    @if ($product[0]->image1 != null)
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="/productImg/{{ $product[0]->image1 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image2 != null)
                        <div class="img-item">
                            <a href="#" data-id="2">
                                <img src="/productImg/{{ $product[0]->image2 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image3 != null)
                        <div class="img-item">
                            <a href="#" data-id="3">
                                <img src="/productImg/{{ $product[0]->image3 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image4 != null)
                        <div class="img-item">
                            <a href="#" data-id="4">
                                <img src="/productImg/{{ $product[0]->image4 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image5 != null)
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="/productImg/{{ $product[0]->image5 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image6 != null)
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="/productImg/{{ $product[0]->image6 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image7 != null)
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="/productImg/{{ $product[0]->image7 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image8 != null)
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="/productImg/{{ $product[0]->image8 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                    @if ($product[0]->image9 != null)
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="/productImg/{{ $product[0]->image9 }}" alt="Product image">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <!-- card right -->
            <div class="product-content">
                <h2 class="product-title">{{ $product[0]->productName }}</h2>
                <div class="product-price">
                    <h3 class="new-price">Price: <span>RM {{ $product[0]->productPrice }}</span></h3>
                    <p class="new-price">Stock: <span>{{ $product[0]->productStock }}</span></p>
                    <p class="new-price">Sold: <span>{{ $product[0]->productSold }}</span></p>
                    @if ($product[0]->status == 'up')
                        <p class="new-price">Status: <span>Selling</span></p>
                    @endif
                    @if ($product[0]->status == 'down')
                        <p class="new-price">Status: <span>Not Selling</span></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-wrapper">
        <div class="card">
            <div class="product-content">
                <h2 class="product-title">Description</h2>
                <div class="product-detail">
                    <h2>about this item: </h2>
                    <p style="font-size: 16px; font-weight:700">Category: {{ $product[0]->category }}</p>
                    <p style="font-size: 16px;">{{ $product[0]->productDesc }}</p>
                </div>

            </div>
            <div class="product-imgs">
                <div class="img-display">
                    <div class="img-showcase">
                        <img src="/productImg/{{ $product[0]->image1 }}" class="displayImg" alt="product image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-wrapper">
        <div class="card">
            <div class="container text-center">
                <h2 class="prodSales-title">Product Sales</h2>
                <div class="row">
                    <div class="col">
                        <h4 class="prodSales-content-title">Product Sold</h4>
                        <h4 class="prodSales-content-content">{{ $product[0]->productSold }}</h4>
                    </div>
                    <div class="col">
                        <h4 class="prodSales-content-title">Current Stock</h4>
                        <h4 class="prodSales-content-content">{{ $product[0]->productStock }}</h4>
                    </div>
                    <div class="col">
                        <h4 class="prodSales-content-title">Popularity (View By Customer)</h4>
                        <h4 class="prodSales-content-content">{{ $product[0]->popularity }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4 class="prodSales-content-title">Status</h4>
                        @if ($product[0]->status == 'up')
                            <h4 class="prodSales-content-content">Selling</h4>
                        @endif
                        @if ($product[0]->status == 'down')
                            <h4 class="prodSales-content-content">Not Selling</h4>
                        @endif
                    </div>
                    <div class="col">
                        <h4 class="prodSales-content-title">Product Authenticity</h4>
                        @if ($product[0]->authentication == 0)
                            <h4 class="prodSales-content-content">Not Authenticated</h4>
                        @endif
                        @if ($product[0]->authentication == 1)
                            <h4 class="prodSales-content-content">Authenticated</h4>
                        @endif
                    </div>
                    <div class="col">
                        <h4 class="prodSales-content-title">Customer Added to Cart</h4>
                        <h4 class="prodSales-content-content">{{ $addedtocart }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-wrapper" style="width: 100%;">
        <a href="/merchantEditProducts/{{ $id }}" style="width: 20%;"><button class="btn btn-warning"
                style="width: 100%;">Edit</button></a>
    </div>

    <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
    </script>
@endsection

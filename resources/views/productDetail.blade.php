@extends('layout.homeLayout')
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
            background: #576649;
            color: #fff;
            padding: 0 0.3rem;
            transition: all 0.5s ease;
        }

        .product-link:hover {
            color: #bbbbbb;
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
            font-size: 25px;
        }

        .new-price{
            font-size: 25px;
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
                <a href="/merchantStore/{{ $product[0]->id }}" class="product-link">visit store</a>

                <div class="product-price">
                    <p class="new-price">Price: <span>RM {{ $product[0]->productPrice }}</span></p>
                </div>

                <form action="{{ url('cart') }}" method="POST">
                    @csrf
                    <div class="purchase-info">
                        <input type="hidden" name="id" value="{{ $product[0]->productID }}">
                        <input type="hidden" name="image" value="{{ $product[0]->image1 }}">
                        <input type="hidden" name="price" value="{{ $product[0]->productPrice }}">
                        <input type="number" name="quantity" min="1" max="{{ $product[0]->productStock }}"
                            step="1" value="1">

                        <input type="submit" class="btn" style="width: 100px; margin-top: 10px" value="Add to Cart">
                    </div>
                </form>

                <div class="social-links">
                    <p>Share At: </p>
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-pinterest"></i>
                    </a>
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
                    <p>{{ $product[0]->productDesc }}</p>
                </div>

            </div>
            <div class="product-imgs">
                <div class="img-display">
                    <div class="img-showcase">
                        <img src="/productImg/{{ $product[0]->image1 }}" class="displayImg" alt="shoe image">
                    </div>
                </div>
            </div>
        </div>
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

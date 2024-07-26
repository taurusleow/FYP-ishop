@extends('layout.homeLayout')
@section('content')
    <style>
        .carousel-item {
            width: 100%;
        }

        .d-block {
            width: 100%;
            height: 500px;
        }

        .search-bar {
            height: 60px;
            width: 100%;
            background-color: #c6c7c7;
        }

        #searchText {
            width: 50%;
            margin: auto;
            padding: auto;
        }

        .card {
            margin: 30px auto auto auto;
        }

        #categorySlider {
            height: 500px;
        }

        .card-img-top {
            width: 100%;
            max-width: 400px;
            margin: auto;
            max-height: 300px;
        }
    </style>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/1212sales.png" style="width: 100%; max-width: 1200px; margin: auto;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/sales-banner.png" style="width: 100%; max-width: 1200px; margin: auto;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/black-friday.png" style="width: 100%; max-width: 1200px; margin: auto;" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="search-bar">
        <form action="/productSearch" method="GET" role="search">
            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4" id="searchText">
                <div class="input-group">
                    <input type="search" name="search" placeholder="What're you searching for?"
                        aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    <div class="input-group-append">
                        <button id="button-addon1" type="submit" class="btn btn-link text-success"><i
                                class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="categorySlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/appliances.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Appliances</h5>
                                    <a href="/productCat?category=Appliances" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/appGames.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Apps & Games</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Apps & Games') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/art.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Arts, Crafts, & Sewing</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Arts, Crafts, & Sewing') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/automotive.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Automotive Parts & Accessories</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Automotive Parts & Accessories') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/baby.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Baby</h5>
                                    <a href="/productCat?category=Baby" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/beauty.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Beauty & Personal Care</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Beauty & Personal Care') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/books.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Books</h5>
                                    <a href="/productCat?category=Books" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/vinyl.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">CDs & Vinyl</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('CDs & Vinyl') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/cellPhone.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Cell Phones & Accessories</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Cell Phones & Accessories') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/clothing.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Clothing, Shoes and Jewelry</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Clothing, Shoes and Jewelry') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/collectible.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Collectibles & Fine Art</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Collectibles & Fine Art') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/computer.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Computers</h5>
                                    <a href="/productCat?category=Computers" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/electronic.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Electronics</h5>
                                    <a href="/productCat?category=Electronics" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/garden.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Garden & Outdoor</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Garden & Outdoor') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/grocery.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Grocery & Gourmet Food</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Grocery & Gourmet Food') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/handmade.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Handmade</h5>
                                    <a href="/productCat?category=Handmade" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/health.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Health, Household & Baby Care</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Health, Household & Baby Care') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/homeKitchen.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Home & Kitchen</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Home & Kitchen') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/industrial.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Industrial & Scientific</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Industrial & Scientific') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/kindle.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kindle</h5>
                                    <a href="/productCat?category=Kindle" class="btn btn-primary">Browse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/luggage.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Luggage & Travel Gear</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Luggage & Travel Gear') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/movies.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Movies & TV</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Movies & TV') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/music.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Musical Instruments</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Musical Instruments') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/office.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Office Products</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Office Products') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/pet.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Pet Supplies</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Pet Supplies') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/sports.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Sports & Outdoors</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Sports & Outdoors') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/homeImprove.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Tools & Home Improvement</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Tools & Home Improvement') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="/images/toys.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Toys & Games</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Toys & Games') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="/images/videoGames.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Video Games</h5>
                                    @php
                                        echo '<a href="/productCat?category=' . urlencode('Video Games') . '" class="btn btn-primary">Browse</a>';
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#categorySlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categorySlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection

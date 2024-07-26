@extends('layout.homeLayout')
@section('content')
    <style>
        .search-bar {
            height: 150px;
            width: 100%;
            background-color: #c6c7c7;
        }

        #searchText {
            width: 50%;
            margin: auto;
            padding: auto;
        }

        #sort-bar {
            width: 90%;
            margin: auto;
        }

        .card-img-top {
            width: 150px;
            margin: auto;
        }
    </style>

    <div class="search-bar">
        <form action="/productSearch" method="GET" role="search">
            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4" id="searchText">
                <div class="input-group">
                    @if (isset($keyword))
                        <input type="search" name="search" placeholder="What're you searching for?"
                            aria-describedby="button-addon1" class="form-control border-0 bg-light"
                            value="{{ $keyword }}">
                    @else
                        <input type="search" name="search" placeholder="What're you searching for?"
                            aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    @endif

                    <div class="input-group-append">
                        <button id="button-addon1" type="submit" class="btn btn-link text-success"><i
                                class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--Sort latest, popular, top sales, price....provide price range-->
            <div class="input-group" id="sort-bar">
                <select class="form-select" id="inputGroupSelect04" name="sort"
                    aria-label="Example select with button addon">
                    @if (isset($sort))
                        <option value="{{ $sort }}" selected>Sort By ({{ $sort }})</option>
                    @else
                        <option value="default" selected>Sort By</option>
                    @endif
                    <option value="popular">Popular</option>
                    <option value="latest">Latest</option>
                    <option value="sales">Sales</option>
                </select>
                <select class="form-select" id="inputGroupSelect04" name="price"
                    aria-label="Example select with button addon">
                    @if (isset($price))
                        <option value="{{ $price }}" selected>Sort Price ({{ $price }})</option>
                    @else
                        <option value="default" selected>Sort Price</option>
                    @endif
                    <option value="asc">Low to High</option>
                    <option value="dsc">High to Low</option>
                </select>
                <div class="form-floating">
                    @if (isset($min))
                        <input type="number" class="form-control" id="floatingInput" min="1" placeholder="10.00"
                            name="min" value="{{ $min }}">
                    @else
                        <input type="number" class="form-control" id="floatingInput" min="1" placeholder="10.00"
                            name="min">
                    @endif

                    <label for="floatingInput">Min. Price</label>
                </div>
                <div class="form-floating">
                    @if (isset($max))
                        <input type="number" class="form-control" id="floatingInput" min="1" placeholder="10.00"
                            name="max" value="{{ $max }}">
                    @else
                        <input type="number" class="form-control" id="floatingInput" min="1" placeholder="50.00"
                            name="max">
                    @endif
                    <label for="floatingInput">Max. Price</label>
                </div>
                <button class="btn btn-success" type="submit">Apply Filter</button>
            </div>
        </form>
    </div>

    <div class="container text-center">
        @if (isset($searchMerchant))
            @php
                $merchantSize = sizeof($searchMerchant);
                $merchantIndex = 0;
            @endphp

            @while ($merchantSize > 0)
                <div class="row" style="margin-top:30px;">
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($searchMerchant[$merchantIndex]))
                            <div class="col">
                                <div class="card" style="min-height: 300px;">
                                    <div style="min-height: 150px;">
                                        @if (isset($searchMerchant[$merchantIndex]->merchantImg))
                                            <img class="rounded-circle mt-5" width="150px"
                                                src="/merchantImg/{{ $searchMerchant[$merchantIndex]->merchantImg }}">
                                        @else
                                            <img class="rounded-circle mt-5" width="150px"
                                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            @if ($searchMerchant[$merchantIndex]->authorisedMerchant == 1)
                                                <i class="fa-solid fa-user-check" style="color: #576649;"></i>
                                            @endif
                                            {{ $searchMerchant[$merchantIndex]->merchantName }}
                                        </h4>
                                        <a href="/merchantStore/{{ $searchMerchant[$merchantIndex]->id }}"
                                            class="btn btn-primary">View
                                            Store</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php
                            $merchantIndex++;
                            $merchantSize--;
                        @endphp
                    @endfor
                </div>
            @endwhile
        @endif
        @php
            $productSize = sizeof($products);
            $productIndex = 0;
        @endphp
        @while ($productSize > 0)
            <div class="row" style="margin-top:30px;">
                @for ($i = 0; $i < 3; $i++)
                    @if (isset($products[$productIndex]))
                        <div class="col">
                            <div class="card" style="min-height: 300px;">
                                <div style="min-height: 150px;">
                                    <img src="/productImg/{{ $products[$productIndex]->image1 }}" class="card-img-top"
                                        alt="...">
                                </div>
                                <div class="card-body">

                                    <h4 class="card-title">
                                        @if ($products[$productIndex]->authentication == 1)
                                            <i class="fa-sharp fa-solid fa-circle-check" style="color: #576649;"></i>
                                        @endif
                                        {{ $products[$productIndex]->productName }}

                                    </h4>
                                    <h5 class="card-title">RM {{ $products[$productIndex]->productPrice }}</h5>
                                    <a href="/product/{{ $products[$productIndex]->id }}" class="btn btn-primary">View
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @php
                        $productIndex++;
                        $productSize--;
                    @endphp
                @endfor
            </div>
        @endwhile

    </div>
    <div class="d-flex justify-content-center" style="margin-top: 50px; margin-bottom: 50px;">
        {{ $products->links('pagination::tailwind') }}
    </div>
@endsection

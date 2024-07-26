@extends('layout.merchantLayout')
@section('content')
    <style>
        /*custom font*/
        @import url(https://fonts.googleapis.com/css?family=Montserrat);

        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            margin-top: 30px;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        /*buttons*/
        #msform .action-button {
            width: 100px;
            background: #576649;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #576649;
        }

        #msform .action-button-previous {
            width: 100px;
            background: #C5C5F1;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
        }

        /*headings*/
        .fs-title {
            font-size: 18px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            list-style-type: none;
            color: black;
            text-transform: uppercase;
            font-size: 9px;
            width: 33%;
            float: left;
            position: relative;
            letter-spacing: 1px;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 24px;
            height: 24px;
            line-height: 26px;
            display: block;
            font-size: 12px;
            color: black;
            background: white;
            border-radius: 25px;
            margin: 0 auto 10px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1;
            /*put it behind the numbers*/
        }

        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #576649;
            color: white;
        }
    </style>

    <div class="row" style="width: 100%;">
        <div class="col-md-max">
            <form id="msform" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">Product Details</li>
                    <li>Product Images</li>
                    <li>Genuine Product Authentication</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">Product Details</h2>
                    <h3 class="fs-subtitle">Provide Detail of Your Product</h3>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('productname') is-invalid @enderror"
                                    id="floatingInput" name="productname" value="{{ old('productname') }}"
                                    placeholder="product name" required>
                                <label for="floatingInput">Product Name</label>
                            </div>
                            @error('productname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="category" name="category"
                                    aria-label="Default select example" required>
                                    <option value="Appliances" selected>Appliances</option>
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
                                <label class="labels" for="category">Product Category</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('productDescription') is-invalid @enderror" placeholder="product description"
                                    name="productDescription" id="floatingTextarea2" style="height: 100px;">{{ old('productDescription') }}</textarea>
                                @error('productDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="labels" for="floatingTextarea2">Product Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input id="price" type="number" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ old('price') }}" min="0.01" required>
                                <label class="labels" for="price">Product Price (RM)</label>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="1" id="stock"
                                    class="form-control @error('stock') is-invalid @enderror"name="stock"
                                    value="{{ old('stock') }}" min="1">
                                <label class="labels" for="stock">Current Product Stock</label>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>
                <fieldset>
                    <h2 class="fs-title">Product Images</h2>
                    <h3 class="fs-subtitle">Upload Your Product Images</h3>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img1" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image1" class="form-label" style="float: left;">Image 1</label>
                            <input id="image1" class="form-control @error('image1') is-invalid @enderror"
                                type="file" name="image1">
                            @error('image1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img2" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image2" class="form-label" style="float: left;">Image 2</label>
                            <input id="image2" class="form-control @error('image2') is-invalid @enderror"
                                type="file" name="image2">
                            @error('image2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img3" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image3" class="form-label" style="float: left;">Image 3</label>
                            <input id="image3" class="form-control @error('image3') is-invalid @enderror"
                                type="file" name="image3">
                            @error('image3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img4" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image4" class="form-label" style="float: left;">Image 4</label>
                            <input id="image4" class="form-control @error('image4') is-invalid @enderror"
                                type="file" name="image4">
                            @error('image4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img5" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image5" class="form-label" style="float: left;">Image 5</label>
                            <input id="image5" class="form-control @error('image5') is-invalid @enderror"
                                type="file" name="image5">
                            @error('image5')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img6" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image6" class="form-label" style="float: left;">Image 6</label>
                            <input id="image6" class="form-control @error('image6') is-invalid @enderror"
                                type="file" name="image6">
                            @error('image6')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img7" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image7" class="form-label" style="float: left;">Image 7</label>
                            <input id="image7" class="form-control @error('image7') is-invalid @enderror"
                                type="file" name="image7">
                            @error('image7')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img8" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image8" class="form-label" style="float: left;">Image 8</label>
                            <input id="image8" class="form-control @error('image8') is-invalid @enderror"
                                type="file" name="image8">
                            @error('image8')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <img id="img9" src="#" width="100px" alt="Product Image" />
                        </div>
                        <div class="col-md-9">
                            <label for="image9" class="form-label" style="float: left;">Image 9</label>
                            <input id="image9" class="form-control @error('image9') is-invalid @enderror"
                                type="file" name="image9">
                            @error('image9')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>
                <fieldset>
                    <h2 class="fs-title">Genuine Product Authentication</h2>
                    <h3 class="fs-subtitle">Upload Supporting Document to Prove Your Product's Authenticity</h3>
                    <div class="row mt-2" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <label for="document" class="form-label" style="float: left;">Supporting Document (PDF only)</label>
                            <input id="document" class="form-control @error('document') is-invalid @enderror"
                                type="file" name="document">
                            @error('document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                </fieldset>
                <input type="submit" name="submit" class="submit action-button" value="Submit" />
            </form>
        </div>
    </div>
    <script>
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function() {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function() {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1 - now) * 50) + "%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });
    </script>
    <script>
        const imgInp1 = document.getElementById("image1");
        const imgInp2 = document.getElementById("image2");
        const imgInp3 = document.getElementById("image3");
        const imgInp4 = document.getElementById("image4");
        const imgInp5 = document.getElementById("image5");
        const imgInp6 = document.getElementById("image6");
        const imgInp7 = document.getElementById("image7");
        const imgInp8 = document.getElementById("image8");
        const imgInp9 = document.getElementById("image9");
        const imgInp10 = document.getElementById("variantImg1");
        const imgInp11 = document.getElementById("variantImg2");
        const imgInp12 = document.getElementById("variantImg3");
        const imgInp13 = document.getElementById("variantImg4");
        const imgInp14 = document.getElementById("variantImg5");

        const img1 = document.getElementById("img1");
        const img2 = document.getElementById("img2");
        const img3 = document.getElementById("img3");
        const img4 = document.getElementById("img4");
        const img5 = document.getElementById("img5");
        const img6 = document.getElementById("img6");
        const img7 = document.getElementById("img7");
        const img8 = document.getElementById("img8");
        const img9 = document.getElementById("img9");
        const img10 = document.getElementById("variantImgDisplay1");
        const img11 = document.getElementById("variantImgDisplay2");
        const img12 = document.getElementById("variantImgDisplay3");
        const img13 = document.getElementById("variantImgDisplay4");
        const img14 = document.getElementById("variantImgDisplay5");

        imgInp1.onchange = evt => {
            const [file] = imgInp1.files;
            if (file) {
                img1.src = URL.createObjectURL(file);
            }
        }
        imgInp2.onchange = evt => {
            const [file] = imgInp2.files;
            if (file) {
                img2.src = URL.createObjectURL(file);
            }
        }
        imgInp3.onchange = evt => {
            const [file] = imgInp3.files;
            if (file) {
                img3.src = URL.createObjectURL(file);
            }
        }
        imgInp4.onchange = evt => {
            const [file] = imgInp4.files;
            if (file) {
                img4.src = URL.createObjectURL(file);
            }
        }
        imgInp5.onchange = evt => {
            const [file] = imgInp5.files;
            if (file) {
                img5.src = URL.createObjectURL(file);
            }
        }
        imgInp6.onchange = evt => {
            const [file] = imgInp6.files;
            if (file) {
                img6.src = URL.createObjectURL(file);
            }
        }
        imgInp7.onchange = evt => {
            const [file] = imgInp7.files;
            if (file) {
                img7.src = URL.createObjectURL(file);
            }
        }
        imgInp8.onchange = evt => {
            const [file] = imgInp8.files;
            if (file) {
                img8.src = URL.createObjectURL(file);
            }
        }
        imgInp9.onchange = evt => {
            const [file] = imgInp9.files;
            if (file) {
                img9.src = URL.createObjectURL(file);
            }
        }
        imgInp10.onchange = evt => {
            const [file] = imgInp10.files;
            if (file) {
                img10.src = URL.createObjectURL(file);
            }
        }
        imgInp11.onchange = evt => {
            const [file] = imgInp11.files;
            if (file) {
                img11.src = URL.createObjectURL(file);
            }
        }
        imgInp12.onchange = evt => {
            const [file] = imgInp12.files;
            if (file) {
                img12.src = URL.createObjectURL(file);
            }
        }
        imgInp13.onchange = evt => {
            const [file] = imgInp13.files;
            if (file) {
                img13.src = URL.createObjectURL(file);
            }
        }
        imgInp14.onchange = evt => {
            const [file] = imgInp14.files;
            if (file) {
                img14.src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection

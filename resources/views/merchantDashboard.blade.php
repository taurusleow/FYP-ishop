@extends('layout.merchantLayout')
@section('content')
    <style>
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
    </style>

    <div class="container rounded bg-inherit mt-5 mb-5">
        @foreach ($products as $product)
            @if ($product->productStock < 1)
                <div class="alert-danger">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Warning!</strong> <a
                        href="/merchantProducts/{{ $product->productID }}">{{ $product->productName }}</a> is out of stock.
                </div>
            @endif
            @if ($product->productStock >= 1 && $product->productStock <= 5)
                <div class="alert-warning">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Warning!</strong> <a
                        href="/merchantProducts/{{ $product->productID }}">{{ $product->productName }}</a> stock running low.
                </div>
            @endif
        @endforeach
        @if (sizeOf($orders) > 0)
            <div class="alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Yeah!</strong> <a href="/merchantOrders">New Order</a> coming!
            </div>
        @endif
    </div>
    <div class="container rounded bg-white mt-5 mb-2">
        <div id="lineChart" style="width:100%; height:500px; margin: auto;"></div>
    </div>
    <div class="container rounded bg-white mt-3 mb-5" style="width: 45%; float: left; margin-left: 60px;">
        <div id="barChartStock" style="width:100%; max-width:600px; height:500px;"></div>
    </div>
    <div class="container rounded bg-white mt-3 mb-5" style="width: 45%; float: left; margin-left: 20px;">
        <div id="barChartSales" style="width:100%; max-width:600px; height:500px;"></div>
    </div>

    <script>
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Set Data
            var jan = 0,
                feb = 0,
                mar = 0,
                apr = 0,
                may = 0,
                june = 0,
                july = 0,
                aug = 0,
                sep = 0,
                oct = 0,
                nov = 0,
                dec = 0;
            @foreach ($sales as $sale)
                @php
                    $dateTime = new DateTime($sale->created_at);
                @endphp
                @if ($dateTime->format('m') == 1)
                    jan += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 2)
                    feb += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 3)
                    mar += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 4)
                    apr += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 5)
                    may += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 6)
                    june += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 7)
                    july += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 8)
                    aug += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 9)
                    sep += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 10)
                    oct += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 11)
                    nov += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @elseif ($dateTime->format('m') == 12)
                    dec += ({{ $sale->productPrice }} * {{ $sale->quantity }})
                @endif
            @endforeach
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Sales(RM)'],
                ['January', jan],
                ['February', feb],
                ['March', mar],
                ['April', apr],
                ['May', may],
                ['June', june],
                ['July', july],
                ['August', aug],
                ['September', sep],
                ['October', oct],
                ['November', nov],
                ['December', dec]
            ]);
            // Set Options
            var options = {
                title: 'Sales Per Month',
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Sales (RM)'
                },
                legend: 'none'
            };
            // Draw
            var chart = new google.visualization.LineChart(document.getElementById('lineChart'));
            chart.draw(data, options);
        }
    </script>
    <script>
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Product', 'Stock'],
                @if (sizeof($products)<1)
                    ['No Product', 0]
                @endif
                @foreach ($products as $product)
                    ['{{ $product->productName }}', {{ $product->productStock }}],
                @endforeach
            ]);

            var options = {
                title: 'Stock in store'
            };

            var chart = new google.visualization.BarChart(document.getElementById('barChartStock'));
            chart.draw(data, options);
        }
    </script>
    <script>
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Product', 'Sold'],
                @if (sizeof($products)<1)
                    ['No Product', 0]
                @endif
                @foreach ($products as $product)
                    ['{{ $product->productName }}', {{ $product->productSold }}],
                @endforeach
            ]);

            var options = {
                title: 'Product Selling Chart'
            };

            var chart = new google.visualization.BarChart(document.getElementById('barChartSales'));
            chart.draw(data, options);
        }
    </script>
@endsection

@extends('layout.adminLayout')
@section('content')
    <style>
        .prodSales-content-content {
            font-size: 20px;
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

        .col {
            transition: .1s;
        }

        .col:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container rounded bg-white mt-5 mb-5">
        <div id="lineChart" style="width:100%; height:500px; margin: auto;"></div>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="container text-center">
            <h2 class="prodSales-title">I-Shop Information</h2>
            <div class="row">
                <div class="col">
                    <h4 class="prodSales-content-title">Total Customers</h4>
                    <h4 class="prodSales-content-content">{{ $totalCustomers }}</h4>
                </div>
                <div class="col">
                    <h4 class="prodSales-content-title">Total Merchants</h4>
                    <h4 class="prodSales-content-content">{{ $totalMerchant }}</h4>
                </div>
                <div class="col">
                    <h4 class="prodSales-content-title">Pending Merchant Authentication</h4>
                    <h4 class="prodSales-content-content">{{ $totalMerchantAuthentication }}</h4>
                </div>
                <div class="col">
                    <h4 class="prodSales-content-title">Pending Product Authentication</h4>
                    <h4 class="prodSales-content-content">{{ $totalProductAuthentication }}</h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Set Data
            var jan = 0.0,
                feb = 0.0,
                mar = 0.0,
                apr = 0.0,
                may = 0.0,
                june = 0.0,
                july = 0.0,
                aug = 0.0,
                sep = 0.0,
                oct = 0.0,
                nov = 0.0,
                dec = 0.0;
            @foreach ($sales as $sale)
                @php
                    $dateTime = new DateTime($sale->created_at);
                @endphp
                @if ($dateTime->format('m') == 1)
                    jan += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 2)
                    feb += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 3)
                    mar += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 4)
                    apr += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 5)
                    may += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 6)
                    june += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 7)
                    july += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 8)
                    aug += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 9)
                    sep += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 10)
                    oct += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 11)
                    nov += {{ $sale->total }}
                @elseif ($dateTime->format('m') == 12)
                    dec += {{ $sale->total }}
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
@endsection

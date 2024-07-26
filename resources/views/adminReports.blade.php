@extends('layout.adminLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div id="imguri"></div>
        @php
            echo 'Current Date and Time:' . date('d/M/Y h:i:sa');
        @endphp
        <div id="lineChart" style="width:100%; height:500px; margin: auto;"></div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5" id="table">
        <div class="row">
            <div id="result">
                <button id="convert" class="btn btn-primary">
                    Request Download Table as Image
                </button>
            </div>

            @php
                echo 'Current Date and Time:' . date('d/M/Y h:i:sa');
            @endphp
        </div>

        <div class="row">
            <div class="col-md-6 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Search Keyword by Customers</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover" id="sortTable">
                            <thead>
                                <th>Keyword</th>
                                <th>Rate</th>
                            </thead>
                            <tbody>
                                @foreach ($productSearch as $ps)
                                    <tr>
                                        <td style="max-width: 100px;">
                                            <p>{{ $ps->keyword }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $ps->rate }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Product Categories Popularity</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover" id="sortTable2">
                            <thead>
                                <th>Product Category</th>
                                <th>Popularity(Rate)</th>
                            </thead>
                            <tbody>
                                @foreach ($popularCategory as $pg)
                                    <tr>
                                        <td style="max-width: 100px;">
                                            <p>{{ $pg->category }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $pg->popularity }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        //convert table to image
        function convertToImage() {
            var resultDiv = document.getElementById("result");
            html2canvas(document.getElementById("table"), {
                onrendered: function(canvas) {
                    var img = canvas.toDataURL("image/png");
                    result.innerHTML = '<a download="ishop-sales-detail.png" href="' + img +
                        '" class="btn btn-success">Download Now</a>';
                }
            });
        }
        //click event
        var convertBtn = document.getElementById("convert");
        convertBtn.addEventListener('click', convertToImage);
    </script>
    <script>
        $('#sortTable').DataTable();
        $('#sortTable2').DataTable();
    </script>
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
                title: 'I-Shop Grand Total Sales Per Month',
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Sales (RM)'
                },
                legend: 'none'
            };
            // Draw
            var imguri = document.getElementById('imguri');
            var chart_div = document.getElementById('lineChart');
            var chart = new google.visualization.LineChart(chart_div);

            google.visualization.events.addListener(chart, 'ready', function() {
                imguri.innerHTML = '<a href="' + chart.getImageURI() +
                    '" class="btn btn-primary" download>Export Graph</a>';
            });
            chart.draw(data, options);
        }
    </script>
@endsection

@extends('layout.merchantLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-2">
        <div id="imguri"></div>
        @php
            echo 'Current Date and Time:' . date('d/M/Y h:i:sa');
        @endphp
        <div id="lineChart" style="width:100%; height:500px; margin: auto;"></div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5" id="table">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Sales Shown in Table</h4>

                        @php
                            echo 'Current Date and Time:' . date('d/M/Y h:i:sa');
                        @endphp
                        <div id="result">
                            <button id="convert" class="btn btn-primary">
                                Request Download Table as Image
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover" id="sortTable">
                            <thead>
                                <th>Customer Email</th>
                                <th>Product Name</th>
                                <th>Order Quantity</th>
                                <th>Order Total</th>
                                <th>Order Date</th>
                            </thead>
                            <tbody>
                                @foreach ($salesDetail as $detail)
                                    <tr>
                                        <td style="max-width: 100px;">
                                            <p>{{ $detail->email }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $detail->productName }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $detail->quantity }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>RM{{ $detail->productPrice * $detail->quantity }}</p>
                                        </td>
                                        @php
                                            $getDate = new DateTime($detail->created_at);
                                        @endphp
                                        <td style="max-width: 100px;">
                                            <p>{{ $getDate->format('Y/M/d') }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $salesDetail->links('pagination::tailwind') }}
                        </div>
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
                    result.innerHTML = '<a download="sales-table.png" href="' + img +
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
    </script>
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
                title: 'Sales In Year(Per Month)',
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

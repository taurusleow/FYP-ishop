@extends('layout.merchantLayout')

@section('content')
    <style>
        td{
            text-align: left;
        }
    </style>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Type of Report's</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Delivery Report</h5>
                                        <p>Result of Successful Delivery to Customer</p>
                                    </td>
                                    <td>
                                        <a href="/deliveryReport"><button class="btn btn-outline-primary">View</button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Total Number of Return and Refund Request</h5>
                                        <p>Result of Return and Refund request from Customer</p>
                                    </td>
                                    <td>
                                        <a href="/refundReport"><button class="btn btn-outline-primary">View</button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Sales Report</h5>
                                        <p>Result of how many order has been placed</p>
                                    </td>
                                    <td>
                                        <a href="/salesReport"><button class="btn btn-outline-primary">View</button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Store's Sales Report</h5>
                                        <p>Provide overall sales made in year shown in graph and list</p>
                                    </td>
                                    <td>
                                        <a href="/merchantSalesReport"><button class="btn btn-outline-primary">View</button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.adminLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">I-shop Voucher</h4>
                        <a href="/adminAddVoucher"><button type="button" class="btn btn-outline-primary"><i
                            class="fa-regular fa-plus"></i> Add New</button></a>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover" id="sortTable">
                            <thead>
                                <th>Voucher Code</th>
                                <th>Quantity</th>
                                <th>Discount(%)</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $voucher)
                                    <tr>
                                        <td style="max-width: 100px;">
                                            <p>{{ $voucher->voucherCode }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $voucher->quantity }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $voucher->discountRate*100 }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $voucher->startDate }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <p>{{ $voucher->endDate }}</p>
                                        </td>
                                        <td style="max-width: 100px;">
                                            <a href="/adminEditVoucher/{{ $voucher->id }}"><button
                                                    class="btn btn-warning">Edit</button></a>
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
        $('#sortTable').DataTable();
    </script>
@endsection

@extends('layout.homeLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Add New Voucher</h4>
                    </div>
                    <form method="POST" action="/adminEditVoucher/{{ $voucher->id }}">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Voucher Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    placeholder="voucher code" name="code" value="{{ $voucher->voucherCode }}" required>
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Voucher Name</label>
                                <input type="text" class="form-control @error('desc') is-invalid @enderror"
                                    value="{{ $voucher->voucherDesc }}" name="desc" placeholder="voucher name" required>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Discount Given (%)</label>
                                <input type="number" step="1" min="1" max="100" class="form-control @error('discount') is-invalid @enderror"
                                    placeholder="eg: 5 = 5%" name="discount" value="{{ $voucher->discountRate*100 }}" required>
                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Quantity Given</label>
                                <input type="number" step="1" min="1" class="form-control @error('quantity') is-invalid @enderror"
                                    value="{{ $voucher->quantity }}" name="quantity" placeholder="quantity" required>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Start Date</label>
                                <input type="datetime-local" class="form-control @error('sDate') is-invalid @enderror"
                                    placeholder="eg: personal account" name="sDate" value="{{ $voucher->startDate }}">
                                @error('sDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">End Date</label>
                                <input type="datetime-local" class="form-control @error('eDate') is-invalid @enderror"
                                    value="{{ $voucher->endDate }}" name="eDate" placeholder="card">
                                @error('eDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-success profile-button" type="submit" style="float: right;">Save
                                Voucher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

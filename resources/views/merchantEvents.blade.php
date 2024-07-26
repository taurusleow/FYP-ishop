@extends('layout.merchantLayout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Events</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <img class="rounded" width="100px"
                                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                    </td>
                                    <td>
                                        <h5>Home</h5>
                                        <p>888, Jalan Wang 8, Taman Wang, 09000 Kulim, Kedah.</p>
                                    </td>
                                    <td>
                                        <a href="/merchantEditOrder"><button class="btn btn-outline-primary">Edit</button></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img class="rounded" width="100px"
                                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                    </td>
                                    <td>
                                        <h5>Home</h5>
                                        <p>888, Jalan Wang 8, Taman Wang, 09000 Kulim, Kedah.</p>
                                    </td>
                                    <td>
                                        <a href="/merchantEditOrder"><button class="btn btn-outline-primary">Edit</button></a>
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

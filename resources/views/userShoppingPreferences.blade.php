@extends('layout.homeLayout')
@section('content')
    <style>
        .profileLinksContainer {
            width: 100%;
            margin: auto;
            height: auto;
            text-align: center;
        }

        .profileLink {
            color: black;
            width: 16%;
            text-align: center;
            height: 35px;
            line-height: 35px;
            display: inline-block;
            margin: auto;
            transition: .1s;
        }

        .profileLink:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #576649;
        }

        @media screen and (max-width: 1400px) {
            .profileLink {
                width: 100%;
            }
        }
    </style>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="profileLinksContainer">
            <a href="/profile" class="profileLink">My Profile</a>
            <a href="/userAddress" class="profileLink">My Address Book</a>
            <a href="/payMethod" class="profileLink">My Payment Method</a>
            <a href="/prodRec" class="profileLink">My Shopping Preferences</a>
            <a href="/userOrderStatus" class="profileLink">Order Status</a>
            <a href="/userOrderHistory" class="profileLink">Order History</a>
        </div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-max border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">My Shopping Preferences</h4>
                    </div>
                    <form method="POST" action="/prodRec/update" enctype="multipart/form-data">
                        @csrf
                        @php
                            $recSize = sizeof($prodRec);
                            $count = 1;
                        @endphp
                        @while ($recSize != 0)
                            <div class="row mt-2">
                                @foreach ($prodRec as $rec)
                                    <div class="col-md-4">
                                        <label class="labels">{{ $rec->productCategory }}</label>
                                        <input type="hidden" name="name{{ $count }}"
                                            value="{{ $rec->productCategory }}"><br />
                                        @if ($rec->rate == 1)
                                            <input type="text" id="textInput{{ $count }}" value="Not Interested"
                                                style="color: #d80000; border:0; background-color: inherit;" disabled>
                                        @elseif ($rec->rate == 2)
                                            <input type="text" id="textInput{{ $count }}" value="Interested"
                                                style="color: #b3b300; border:0; background-color: inherit;" disabled>
                                        @elseif ($rec->rate == 3)
                                            <input type="text" id="textInput{{ $count }}" value="Very Interested"
                                                style="color: #00b300; border:0; background-color: inherit;" disabled>
                                        @endif

                                        <input type="range" id="rangeInput{{ $count }}" class="form-range"
                                            min="1" max="3" value="{{ $rec->rate }}"
                                            name="range{{ $count }}"
                                            onchange="updateTextInput(this.value, {{ $count }})">
                                    </div>
                                    @php
                                        $recSize--;
                                        $count++;
                                    @endphp
                                @endforeach
                            </div>
                        @endwhile

                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                                Profile</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTextInput(val, id) {
            let string = "textInput";
            var getID = string.concat(id)
            let getTextInput = document.getElementById(getID);

            if (val == 1) {
                getTextInput.value = "Not Interested";
                getTextInput.style.color = "#d80000";
            } else if (val == 2) {
                getTextInput.value = "Interested";
                getTextInput.style.color = "#b3b300";
            } else if (val == 3) {
                getTextInput.value = "Very Interested";
                getTextInput.style.color = "#00b300";
            }
        }
    </script>
@endsection

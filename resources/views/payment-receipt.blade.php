<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <style>
        h5 {
            font-size: 16px
        }
    </style>

</head>


<body>
    @php
        use Carbon\Carbon;
    @endphp

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card px-2">
                        <div class="card-body">

                            <div id="canvasElement" class="cert-text py-5 px-3 ">

                                <h1 style="font-size: 30px">INVOICE</h1>
                                <div class="mt-5">
                                    <h5>Your Name : {{ auth()->user()->name }}</h5>
                                    <h5>Your Email : {{ auth()->user()->email }}</h5>
                                    <h5>Your Phone : {{ auth()->user()->phone }}</h5>
                                </div>
                                <div class="row billMargin" style="display: flex; margin-top:30px ">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Buyer Name : {{ $validatedData['name'] }}</th>
                                                <th>Invoice Number : {{ $validatedData['invoice_number'] }}</th>
                                            </tr>
                                            <tr>
                                                <th>Buyer Address : {{ $validatedData['address'] }}</th>
                                                <th>Invoice Due : 12/07/2020 </th>
                                            </tr>
                                            <tr>
                                                <th>Buyer Email : {{ $validatedData['email'] }}</th>
                                            </tr>
                                            <tr>
                                                <th>Buyer Phone : {{ $validatedData['phone'] }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Item</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price per unit</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>#</td>
                                                <td>$0.00</td>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>#</td>
                                                <td>$0.00</td>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>#</td>
                                                <td>$0.00</td>
                                                <td>$0.00</td>
                                            </tr>
                                        </tbody>
                                    </table> --}}
                                    @if (isset($validatedData['item_number']))
                                        @php
                                            $itemCount = $validatedData['item_number'];
                                        @endphp
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price per unit</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= $itemCount; $i++)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>#</td>
                                                        <td>$0.00</td>
                                                        <td>$0.00</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No item count provided.</p>
                                    @endif

                                </div>
                                <div class="d-flex justify-content-end align-content-end w-100">
                                    <div class="">
                                        <h5>Sub Total : 0.00</h5>
                                        <h5>Fees/Diccounts : 0.00</h5>
                                        <h5>Tax : 0.00</h5>
                                        <h5>Total : 0.00</h5>
                                    </div>
                                </div>

                                <div class="dottedbox row">
                                    <div class="col-md-9 ms-auto" style="position: absolute; right: 0px;">
                                        <div id="previewImage"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- partial -->
    </div>


</body>

</html>

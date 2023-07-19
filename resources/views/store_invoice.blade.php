@extends('layouts.app')
@section('head')
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <style>
        body {

            color: #444d26;
        }

        .cert-text {
            font-family: 'Merriweather', serif;
        }

        .certificate {
            font-size: 54px;
            font-weight: 700;
            color: #000;
            margin-left: 350px;
        }

        .container {
            width: 100%;
        }

        #page-container {
            background-image: url("{{ asset('/assets/img/invoice.png') }}");
            /* background-image: url("{{ asset('/assets/img/cert/icv-test.jpg') }}"); */

            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 100%;
            height: 100vh;
            display: grid;
            /* place-items: center; */
            border: 2px solid red;
        }

        #canvasElement {
            position: relative;
            top: 0;
        }

        .cert-text {
            padding: 100px;

        }

        h5 {
            font-size: 10px;
        }

        .billMargin {
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Preview Invoice</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Preview Invoice</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Invoice Preview</h5>

                            <div id="previewImage" class="img-fluid" style="overflow: scroll"></div>

                            <div id="page-container">
                                <div id="canvasElement" class="cert-text py-5 px-3 ">

                                    <h1 style="font-size: 20px">INVOICE</h1>
                                    <div class="mt-5">
                                        <h5>Your Name : {{ auth()->user()->name }}</h5>
                                        {{-- <h5>Your Address :</h5> --}}
                                        <h5>Your Email : {{ auth()->user()->email }}</h5>
                                        <h5>Your Phone : {{ auth()->user()->phone }}</h5>
                                    </div>
                                    <div class="row billMargin">
                                        <div class="col-6">
                                            <h5>Bill To :</h5>
                                            <h5>Buyer Name :</h5>
                                            <h5>Buyer Address :</h5>
                                            <h5>Buyer Email :</h5>
                                            <h5>Buyer Phone :</h5>
                                        </div>
                                        <div class="col-6">
                                            <h5>Invoice Number :</h5>
                                            <h5>Invoice Due :</h5>
                                        </div>
                                    </div>
                                    <div class="mt-5" style="font-size: 10px">
                                        <table class="table">
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
                                        </table>
                                    </div>
                                    <div class="billMargin d-flex justify-content-end align-content-end w-100 px-5  ">
                                        <div class="">
                                            <h5>Sub Total : 0.00</h5>
                                            <h5>Fees/Diccounts : 0.00</h5>

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
                            <div class="card-footer">
                                <div class="text-center">
                                    <a id="btn-Convert-jpg" class="btn btn-primary">Download JPG</a>
                                    <a id="btn-Convert-Html2Image" class="btn btn-primary"> <i
                                            class="fas fa-file-download"></i>
                                        Download PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $certFileName = 'Invoive.pdf';
        $(document).ready(function() {
            var element = $("#page-container"); // global variable
            var getCanvas; // global variable

            html2canvas(document.querySelector("#page-container")).then(canvas => {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
                $("#page-container").remove();
            });

            $("#btn-Convert-Html2Image").on('click', function() {
                var imgageData = getCanvas.toDataURL("image/png");
                // Now browser starts downloading it instead of just showing it
                // var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                // $("#btn-Convert-Html2Image").attr("download", "MyCertficate.png").attr("href", newData);

                var pdf = new jsPDF({
                    orientation: "portrait",
                    unit: "px",
                    format: [1380, 1970]
                });


                pdf.addImage(imgageData, 'JPEG', 0, 0);

                pdf.save($certFileName);

                // $('#my_hidden').val(imgageData);
                // $('form').submit();

            });

            $("#btn-Convert-jpg").on('click', function() {
                var imgageData = getCanvas.toDataURL("image/jpeg"); // Change "image/png" to "image/jpeg"

                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/jpeg/,
                    "data:application/octet-stream"); // Change "image/png" to "image/jpeg"
                $("#btn-Convert-jpg").attr("download",
                    "Certificate.jpg").attr(
                    "href",
                    newData); // Change file extension to .jpg
            });
        });
    </script>
@endsection

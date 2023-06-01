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

        h1 {
            font-size: 120px;
            font-weight: 700;
        }

        .bname {
            color: #0198db;
            font-weight: 700;
            margin: 0 auto;
            width: 1700px;

        }

        h5 {
            font-size: 65px;
            font-weight: 700;
            color: #000;

        }

        h3 {
            margin-top: -40px;
            font-size: 65px;
        }

        h6 {
            font-size: 45px;
            font-weight: 700;
            color: #000;
            margin-top: 10px;
        }

        p {
            font-size: 18px;
            width: 700px;
            font-weight: 500;
        }

        .container {
            width: 100%;
        }

        #page-container {
            background-image: url("{{ asset('/assets/img/cert/icv-final.png') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 2480px;
            height: 3508px;
            display: grid;
            /* place-items: center; */
            padding-left: 100px;
        }

        #canvasElement {
            position: relative;
            top: 700px;
            left: 100px;
            text-align: center;
        }

        .bname {
            position: absolute;
            top: 200px;
            text-align: center;
            width: 100%;
            padding: 0 200px;
            height: 300px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .bname .first {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .bname .second {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .standerd {
            position: absolute;
            top: 750px;
            left: 800px;
            margin: 0 auto;
        }

        .scope {
            position: absolute;
            top: 1280px;
            left: 300px;
            width: 90%;
            padding: 0 100px;
            margin: 0 auto;
        }

        .scope p {
            width: 90%;
            /* font-size: 24px; */
            display: flex;
            justify-content: center;
            align-items: center;
            /* border: 2px solid red; */
            height: 235px;
        }

        .registered {
            position: absolute;
            top: 410px;
            left: 180px;
            width: 100%;
            margin: 0 auto;
        }

        .registered p {
            width: 90%;
            /* font-size: 28px; */
            display: flex;
            justify-content: center;
            align-items: center;
            /* border: 2px solid red; */
            height: 180px;
        }

        .justify-data {
            position: absolute;
            top: 1550px;
            left: 50px;
            width: 90%;
            margin: 0 auto;
            display: flex;
            justify-content: end;
            flex-direction: column;
            padding-left: 50px;
            width: 90%;
        }

        .justify {
            display: flex;
            justify-content: end;
            padding-left: 50px;
            width: 100%;
        }

        .certificate {
            position: absolute;
            top: 1840px;
            left: 400px;
            width: 90%;
            margin: 0 auto;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Preview Certificate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Preview Certificate</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Certificate Preview</h5>

                            <div id="previewImage" class="img-fluid" style="overflow: scroll"></div>

                            <div id="page-container">
                                <div id="canvasElement" class="cert-text pb-5">
                                    <div class="bname">
                                        <div class="first"
                                            style="font-size: {{ isset($businessSize) ? @$businessSize . 'px' : '80px' }};">
                                            {{ $data->business_name }}</div>
                                        @if ($data->business_name_secondary)
                                            <div class="second"
                                                style="font-size: {{ isset($businessSize) ? @$businessSize . 'px' : '80px' }}; ">
                                                {{ $data->business_name_secondary }}</div>
                                        @endif

                                    </div>

                                    <div class="registered">
                                        <p
                                            style="font-size: {{ isset($registeredSize) ? @$registeredSize . 'px' : '30px' }};">
                                            {{ $data->registered_site }}</p><br><br>
                                    </div>
                                    {{-- <h6>has been audited by ICV and found to be</h6> --}}
                                    {{-- <h6>in compliance with the requirements of the standard</h6> --}}
                                    <br><br>
                                    <div class="standerd">
                                        <div style="font-size:130px;color:navy;">{{ $data->standerd }}</div><br>
                                        <h3 style="color:navy;">(Quality Management System)</h3><br>
                                    </div>
                                    {{-- <h6>This certificate is valid for <br> the following scope:</h6> --}}
                                    <div class="scope">
                                        <p style="font-size: {{ isset($scopeSize) ? @$scopeSize . 'px' : '30px' }};">
                                            {{ $data->scope_registration }}</p><br><br>
                                    </div>


                                    <div class="justify-data">
                                        <h6 class="justify">
                                            {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</span>
                                        </h6>
                                        <h6 class="justify">
                                            <span>{{ @$data->date_registration ? @$data->date_registration : 'XX XXX XX' }}</span>
                                        </h6>
                                        <h6 class="justify">
                                            <span>{{ @$data->first_surveillance_audit ? @$data->first_surveillance_audit : 'XX XXX XX' }}</span>
                                        </h6>
                                        <h6 class="justify">
                                            <span>{{ @$data->second_surveillance_audit ? @$data->second_surveillance_audit : 'XX XXX XX' }}</span>
                                        </h6>
                                        <h6 class="justify">
                                            <span>{{ @$data->certification_due_date ? @$data->certification_due_date : 'XX XXX XX' }}</span>
                                        </h6>
                                    </div>
                                    <br>
                                    <div class="dottedbox row">


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a id="btn-Convert-jpg" class="btn btn-primary">Download JPG</a>
                                <a id="btn-Convert-Html2Image" class="btn btn-primary"> <i class="fas fa-file-download"></i>
                                    Download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->
                <!-- Right side columns -->

                <!-- End Right side columns -->
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $certFileName = 'Certificate.pdf';
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

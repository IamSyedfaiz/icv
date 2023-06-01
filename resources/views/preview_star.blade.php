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

        /* .cert-text {
                                                        *font-family: 'Merriweather', serif;
                                                    } */

        h1 {
            font-size: 50px;
            color: #a0a591;
            font-weight: 700;

        }

        h2 {
            font-size: 54px;
            font-weight: 700;
        }

        h3 {
            font-size: 45px;
            font-weight: 700;
        }

        h6 {
            font-size: 45px;
            font-weight: 400;
            color: #000;
        }

        h4 {
            font-size: 45px;
            font-weight: 700;
            color: #000;
            margin: 10px 0;
        }

        h1 {
            font-size: 100px;
            font-weight: 700;
            margin: 10px 0;
            color: #2e3092 !important;
        }

        .bname {
            color: #2e3092 !important;
            margin: 0 auto;
        }

        p {
            font-size: 18px;
            width: 700px;
        }

        .container {
            width: 100%;
        }

        #page-container {
            background-image: url("{{ asset('/assets/img/cert/star-final.png') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 2480px;
            height: 3508px;
            display: grid;
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
            top: 100px;
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
            top: 650px;
            left: 850px;
            margin: 0 auto;
        }

        .scope {
            position: absolute;
            top: 1380px;
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
            top: 1080px;
            left: 180px;
            width: 100%;
            margin: 0 auto;
        }

        .registered p {
            width: 90%;
            /* font-size: 30px; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .date-text {
            position: absolute;
            top: 1790px;
            left: 700px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            width: 100%;

        }

        .date-text div {
            display: flex;
            align-items: center;
            padding-left: 50px;
            width: 1900px;
            font-size: 35px;
            color: #000;
            margin-bottom: 3px;
        }

        .certificate {
            position: absolute;
            top: 1680px;
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
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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

                                    </div><br>

                                    {{-- <h6>has been formally assessed by</h6> --}}
                                    {{-- <h2 style="color:#000;">Star Certifications UK Limited</h2> --}}
                                    {{-- <h6>and found to comply with the requirements of</h6> --}}
                                    <div class="standerd">
                                        <div style="font-size:130px;color:navy;">{{ $data->standerd }}</div><br>
                                        <h3 style="color:navy;">(Quality Management System)</h3><br>
                                    </div>
                                    {{-- <h6 style="color:#000;font-weight:700;">Registered Site (s):</h6> --}}
                                    <div class="registered">
                                        <p
                                            style="font-size: {{ isset($registeredSize) ? @$registeredSize . 'px' : '30px' }};">
                                            {{ $data->registered_site }}</p><br><br>
                                    </div>
                                    {{-- <h6 style="color:#000;font-weight:700;">Scope of Registration</h6> --}}
                                    <div class="scope">
                                        <p style="font-size: {{ isset($scopeSize) ? @$scopeSize . 'px' : '30px' }};">
                                            {{ $data->scope_registration }}</p><br><br>
                                    </div>
                                    <br><br>
                                    <h6 class="certificate" style="color:#000;font-weight:700;">
                                        {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</h6>
                                    <br>
                                    <div class="dottedbox row">
                                        <div class="dottedbox-right w-100 col-4">
                                            <div class="date-text">
                                                <div class="">
                                                    <div>
                                                        {{ @$data->date_registration ? @$data->date_registration : 'XX XXX XX' }}</span>
                                                    </div>
                                                    <div>
                                                        {{ @$data->first_surveillance_audit ? @$data->first_surveillance_audit : 'XX XXX XX' }}</span>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div>
                                                        <span>{{ @$data->certification_due_date ? @$data->certification_due_date : 'XX XXX XX' }}</span>
                                                    </div>
                                                    <div>
                                                        {{ @$data->second_surveillance_audit ? @$data->second_surveillance_audit : 'XX XXX XX' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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

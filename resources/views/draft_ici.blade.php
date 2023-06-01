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

        h1,
        .bname {
            font-size: 80px;
            color: #000;
            font-weight: 700;
        }

        h2 {
            font-size: 60px;
            font-weight: 700;
            color: #000;

        }

        .standerd {
            font-size: 65px;
            font-weight: 700;
            color: #000;
            /* margin-top: 200px; */
        }

        h3 {
            font-size: 44px;
            color: navy;
            font-weight: 700;
            line-height: 45px;
            margin-top: -60px;
        }

        .certificate {
            font-size: 54px;
            font-weight: 700;
            color: #000;
            margin-left: 350px;
        }

        h6 {
            font-size: 14px;
            font-weight: 700;
            color: #000;
            margin-bottom: 30px;

        }

        p {
            font-size: 30px;
            width: 700px;
        }

        .container {
            width: 100%;
        }

        #page-container {
            background-image: url("{{ asset('/assets/img/cert/ici-test.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 2480px;
            height: 3508px;
            display: grid;
            /* place-items: center; */
            padding-left: 400px;
        }

        #canvasElement {
            position: relative;
            top: 300px;
            text-align: center;
        }

        .bname {
            position: absolute;
            top: 450px;
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
            top: 1000px;
            left: 600px;
            margin: 0 auto;
        }

        .scope {
            position: absolute;
            top: 1380px;
            left: 150px;
            width: 90%;
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
            top: 1660px;
            left: 150px;
            width: 90%;
            margin: 0 auto;
        }

        .registered p {
            width: 90%;
            /* font-size: 24px; */
            display: flex;
            justify-content: center;
            align-items: center;
            /* border: 2px solid red; */
            height: 180px;
        }

        .justify-data {
            position: absolute;
            top: 2000px;
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
            margin-bottom: 150px;
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
                                    {{-- <h6>This is to certify that the management system of</h6><br> --}}
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
                                    {{-- <h2>INTERNATIONAL CERTIFICATION & INSPECTION UK LTD.</h2> --}}
                                    {{-- <h6>and found to comply with the requirements of</h6> --}}
                                    <div class="standerd">
                                        <h2 style="font-size:130px;color:navy;">{{ $data->standerd }}</h2><br>
                                        <h3 style="color:navy;">(Quality Management System)</h3><br>
                                    </div>
                                    <br><br>
                                    {{-- <h6>Scope of Registration</h6><br> --}}
                                    <div class="scope">
                                        <p style="font-size: {{ isset($scopeSize) ? @$scopeSize . 'px' : '30px' }};">
                                            {{ $data->scope_registration }}</p><br><br>
                                    </div>
                                    {{-- <h6>Registered Site (s):</h6><br> --}}
                                    <div class="registered">
                                        <p
                                            style="font-size: {{ isset($registeredSize) ? @$registeredSize . 'px' : '30px' }};">
                                            {{ $data->registered_site }}</p><br><br>
                                    </div>
                                    <h5 class="certificate">&nbsp;
                                        {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</h5>
                                    <br>

                                    <div class="justify-data">
                                        <h3 class="justify" style="color:#000;">

                                            {{ @$data->date_registration ? @$data->date_registration : 'XX XXX XX' }}
                                        </h3>
                                        <br>
                                        <h3 class="justify" style="color:#000;">

                                            {{ @$data->first_surveillance_audit ? @$data->first_surveillance_audit : 'XX XXX XX' }}
                                        </h3>
                                        <br>
                                        <h3 class="justify" style="color:#000;">

                                            {{ @$data->second_surveillance_audit ? @$data->second_surveillance_audit : 'XX XXX XX' }}
                                        </h3>
                                        <br>
                                        <h3 class="justify" style="color:#000;">

                                            {{ @$data->certification_due_date ? @$data->certification_due_date : 'XX XXX XX' }}
                                        </h3>

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
            {{-- // $certFileName = '{{ @$data->business_name ? @$data->business_name : 'Certificate' }}.pdf'; --}}
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

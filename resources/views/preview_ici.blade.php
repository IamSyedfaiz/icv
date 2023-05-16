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
            font-size: 80px;
            color: #000;
            font-weight: 700;

        }

        h2 {
            font-size: 60px;
            font-weight: 700;
        }

        h3 {
            font-size: 44px;
            color: navy;
            font-weight: 700;
            line-height: 45px;
        }

        h5 {
            font-size: 54px;
            font-weight: 700;
            color: #000;
            margin-bottom: 30px;

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
            background-image: url("{{ asset('/assets/img/cert/ICI.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 2480px;
            height: 3508px;
            display: grid;
            place-items: center;
            padding-left: 100px;
        }

        #canvasElement {
            margin: 0px auto 50px;
            text-align: center;
        }




        #canvasElement h6 {
            font-size: 45px;
        }

        #canvasElement p {
            font-size: 30px;
            width: 60%;
            text-align: center;
            line-height: 40px;
            float: none;
            display: block;
            margin: 0 auto;
            color: #000;
        }

        .date-text {
            text-align: center;
            width: 100%;
            display: block;
            margin: 0 auto;
        }

        .date-text div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 50px;
            width: 800px;
            font-size: 24px;
        }

        .justify {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 50px;
            width: 1200px;
            margin-left: 200px;
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
                                    <h6>This is to certify that the management system of</h6><br>
                                    <h1>{{ $data->business_name }}</h1><br>
                                    <h6>has been formally assessed by</h6>
                                    <h2>INTERNATIONAL CERTIFICATION & INSPECTION UK LTD.</h2>
                                    <h6>and found to comply with the requirements of</h6>
                                    <h2 style="font-size:130px;color:navy;">{{ $data->standerd }}</h2><br>
                                    <h3 style="color:navy; margin-botom:130px;">(Quality Management System)</h3><br>
                                    <br><br>
                                    <h6>Scope of Registration</h6><br>
                                    <p>{{ $data->scope_registration }}</p><br><br>
                                    <h6>Registered Site (s):</h6><br>
                                    <p>{{ $data->registered_site }}</p><br><br>
                                    <h5>::CERTIFICATE NO :: &nbsp;
                                        {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</h5>
                                    <br>
                                    <h3 class="justify" style="color:#000;">
                                        Date of initial registration:&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ @$data->date_registration ? @$data->date_registration : 'XX XXX 2023' }}
                                    </h3>
                                    <br>
                                    <h3 class="justify" style="color:#000;">
                                        First Surveillance Audit on or before:&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ @$data->first_surveillance_audit ? @$data->first_surveillance_audit : 'XX XXX XX' }}
                                    </h3>
                                    <br>
                                    <h3 class="justify" style="color:#000;">
                                        Second Surveillance Audit on or before:&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ @$data->second_surveillance_audit ? @$data->second_surveillance_audit : 'XX XXX XX' }}
                                    </h3>
                                    <br>
                                    <h3 class="justify" style="color:#000;">
                                        Re-certification Due:&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ @$data->certification_due_date ? @$data->certification_due_date : 'XX XXX XX' }}
                                    </h3>



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
        $certFileName = '{{ @$data->business_name ? @$data->business_name : 'Certificate' }}.pdf';
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
                    "{{ @$data->business_name ? @$data->business_name : 'Certificate' }}.jpg").attr(
                    "href",
                    newData); // Change file extension to .jpg
            });
        });
    </script>
@endsection

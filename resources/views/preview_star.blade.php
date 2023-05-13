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
            font-size: 50px;
            color: #a0a591;
            font-weight: 700;

        }

        h2 {
            font-size: 34px;
            font-family: 'Gill Sans', sans-serif;
            color: #000;
        }

        h6 {
            font-size: 22px;
            font-weight: 700;
            color: #000;

        }

        p {
            font-size: 18px;
            width: 700px;
        }

        .container {
            width: 100%;
        }

        #page-container {
            background-image: url("{{ asset('/assets/img/cert/STAR.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 2480px;
            height: 3508px;
            display: grid;
            place-items: center;
            padding-left: 100px;
        }

        #canvasElement {
            margin: 0px auto;
            display: block;
            margin-left: 800px;
            text-align: center;
        }

        #canvasElement h6 {
            font-size: 45px;
        }

        #canvasElement p {
            font-size: 24px;
            width: 60%;
            text-align: center;
            line-height: 40px;
            float: none;
            display: block;
            margin: 0 auto;
        }


        .date-text p {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 50px;
            width: 700px;
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

                            <div id="previewImage" class="img-fluid"></div>

                            <div id="page-container">
                                <div id="canvasElement" class="cert-text pb-5">
                                    {{-- <h6>This is to certify that the management system of</h6><br> --}}
                                    <h2>{{ $data->business_name }}</h2><br>
                                    <h6>has been formally assessed by</h6>
                                    <h6>INTERNATIONAL CERTIFICATION & INSPECTION UK LTD.</h6>
                                    <h6>and found to comply with the requirements of</h6>
                                    <h1 style="color:navy;">ISO 9001: 2015</h1><br>
                                    <h6 style="color:navy;">(Quality Management System)</h6>
                                    <h6>Scope of Registration</h6>
                                    <p>{{ $data->scope_registration }}</p>
                                    <h6>Registered Site (s):</h6>
                                    <p>{{ $data->registered_site }}</p><br>
                                    <h6>CERTIFICATE NO : &nbsp;
                                        {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</h6>
                                    <br>
                                    <div class="dottedbox row">
                                        <div class="dottedbox-right w-100 col-4">
                                            <div class="date-text">
                                                <p>Date of initial registration
                                                    &nbsp; &nbsp; <span>
                                                        {{ @$data->date_registration ? @$data->date_registration : 'XX XXX xx' }}</span>
                                                </p>
                                                <p>First Surveillance Audit on or before:
                                                    &nbsp;&nbsp; <span>
                                                        {{ @$data->first_surveillance_audit ? @$data->first_surveillance_audit : 'XX XXX xx' }}</span>
                                                </p>
                                                <p>Second Surveillance Audit on or before:
                                                    &nbsp;&nbsp; <span>
                                                        {{ @$data->second_surveillance_audit ? @$data->second_surveillance_audit : 'XX XXX xx' }}</span>
                                                </p>
                                                <p>Re-certification Due: &nbsp;&nbsp;
                                                    <span>{{ @$data->certification_due_date ? @$data->certification_due_date : 'XX XXX xx' }}</span>
                                                </p>
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

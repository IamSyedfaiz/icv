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
            font-size: 32px;
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
            background-image: url("{{ asset('/assets/img/cert/ICV.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 2480px;
            height: 3508px;
            display: grid;
            place-items: center;
            padding-left: 100px;
        }

        #canvasElement {
            /* margin: 0px auto 50px; */
            margin-top: -400px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-left: 150px;
            text-align: center;
        }

        #canvasElement p {
            font-size: 28px;
            width: 60%;
            text-align: center;
            line-height: 40px;
            float: none;
            display: block;
            margin: 0 auto;
            margin-top: 30px;
        }

        .date-text div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 50px;
            width: 900px;
            font-size: 28px;
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
                                    <h2>{{ $data->business_name }}</h2><br>


                                    <p>{{ $data->registered_site }}</p>
                                    <h6>has been audited by ICV and found to be</h6>
                                    <h6>in compliance with the requirements of the standard</h6>
                                    {{-- <h6>and found to comply with the requirements of</h6> --}}
                                    <h1>ISO 9001: 2015</h1><br>
                                    <h6>(Quality Management System)</h6>
                                    <h6>This certificate is valid for <br> the following scope:</h6>
                                    {{-- <h6>Scope of Registration</h6>
                                    <p>{{ $data->scope_registration }}</p> --}}
                                    {{-- <h6>Registered Site (s):</h6> --}}
                                    <p>{{ $data->scope_registration }}</p><br>
                                    {{-- <h6>CERTIFICATE NO : &nbsp;
                                        {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</h6> --}}
                                    <br>
                                    <div class="dottedbox row">
                                        <div class="dottedbox-right w-100 col-4">
                                            <div class="date-text">
                                                <div>CERTIFICATE NO :
                                                    &nbsp; &nbsp; <span>
                                                        {{ @$data->certificate_number ? @$data->certificate_number : 'DRAFT COPY' }}</span>
                                                </div>
                                                <div>Date of initial registration
                                                    &nbsp; &nbsp; <span>
                                                        {{ @$data->date_registration ? @$data->date_registration : 'XX XXX xx' }}</span>
                                                </div>
                                                <div>First Surveillance Audit on or before:
                                                    &nbsp;&nbsp; <span>
                                                        {{ @$data->first_surveillance_audit ? @$data->first_surveillance_audit : 'XX XXX xx' }}</span>
                                                </div>
                                                <div>Second Surveillance Audit on or before:
                                                    &nbsp;&nbsp; <span>
                                                        {{ @$data->second_surveillance_audit ? @$data->second_surveillance_audit : 'XX XXX xx' }}</span>
                                                </div>
                                                <div>Re-certification Due: &nbsp;&nbsp;
                                                    <span>{{ @$data->certification_due_date ? @$data->certification_due_date : 'XX XXX xx' }}</span>
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

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {

            color: #444d26;
        }

        .cert-text {
            font-family: 'Merriweather', serif;
        }

        h1 {
            font-size: 4.5rem;
            color: #a0a591;
        }

        h2 {
            font-size: 3.5rem;
        }

        h6 {
            font-size: 1.8rem;
        }

        p {

            font-size: 1.5rem;
        }

        .container {
            width: 100%;
        }

        #page-container {
            background-image: url("assets/img/cert/ICI.jpg");
            background-repeat: no-repeat;
            background-size: 1620px 1080px;
            margin: 100px auto 50px;
            width: 1620px;
            height: 1200px;
            display: grid;
            place-items: center;
            /* border: 1px solid black */
        }

        #canvasElement {
            margin: 0px auto 50px;
            text-align: center;
        }

        #test {
            margin: 0px auto 0px;
        }

        #previewImage {
            /* max-width: 60vw !important; */
            height: 68vh;
        }

        #previewImage canvas {
            max-width: 100%;
            height: 100% !important;
        }

        .dottedbox {
            border: 1px dashed rgb(42, 90, 179);
            border-radius: 3px;
            height: 200px;
            width: 1000px;
        }

        .dottedbox-right {
            border-right: 1px dashed rgb(42, 90, 179);
            display: inline-block;
            height: 100%;
        }

        .dottedbox-center {
            display: inline-block;
            height: 100%;
        }

        .dottedbox-left {
            border-left: 1px dashed rgb(42, 90, 179);
            display: inline-block;
            float: right;
            height: 100%;
        }
    </style>
    <title>Hello, world!</title>
</head>

<body>
    <div class="container">

        <div class="row mt-5">
            <div class="col-md-12">

                <div class="col-md-12 pl-3 mb-2">
                    <div class="btns">
                        <a class="btn  btn-outline-primary" href="#">
                            <i class="fas fa-chevron-left"></i> Back
                        </a>
                    </div>

                </div>
                <div class="col-md-12">
                    <div id="previewImage"></div>

                    <div class="btns mt-2">
                        <a id="btn-Convert-Html2Image" class="btn btn-success" href="#">
                            <i class="fas fa-file-download"></i> Download
                        </a>
                    </div>
                </div>

                <div id="page-container">
                    <div id="canvasElement" class="cert-text pb-5">
                        <h2>CERTIFICATE</h2><br>
                        <h6>RECOGNIZES</h6><br>
                        <h1>{{ @$usesPdf->name }}</h1><br>
                        <h6>FOR SUCCESSFULLY COMPLETING THE COURSE IN</h6>
                        <h6>{{ @$usesPdf->name }}</h6>
                        <h6>HAS COMPLETED {{ @$usesPdf->updated_at }}</h6><br>
                        <h2>CERTIFICATE OF TRAINING</h2><br>
                        <p class="pb">COMPLETED {{ @$usesPdf->updated_at }}</p>
                        <div class="dottedbox row">
                            <div class="dottedbox-right col-4 d-flex justify-content-center align-items-center">
                                <div>
                                    <p>From: {{ @$usesPdf->created_at }}</p>
                                    <p>To: {{ @$usesPdf->updated_at }}</p>
                                </div>
                            </div>
                            <div class="dottedbox-center col-4 d-flex justify-content-center align-items-center">
                            </div>
                            <div class="dottedbox-left col-4 d-flex justify-content-center align-items-center">
                                <div>
                                    <p>SAFETY FIRST CONSULTING</p>
                                    <p>________________</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="certcontainer"></div>
        {{-- <form action="/cert-store" method="post">
            @csrf
            <input type="text" hidden name="image_data" id="my_hidden">
            <input type="text" hidden value={{ @$name }} name="name">
            <input type="text" hidden value={{ @$category->title }} name="class_title">
        </form> --}}
        <script>
            $certFileName = '{{ @$category_title ? @$category_title : 'Certificate' }}.pdf';
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
                        orientation: "landscape",
                        unit: "px",
                        format: [910, 610]
                    });

                    pdf.addImage(imgageData, 'JPEG', 0, 0);

                    pdf.save($certFileName);

                    $('#my_hidden').val(imgageData);
                    $('form').submit();

                });
            });
        </script>

</body>

</html>

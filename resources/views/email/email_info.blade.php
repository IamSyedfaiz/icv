<html>

<head>
    <title>RACAP</title>
</head>

<body>
    <h1>User Login ID</h1>
    <p>User Name: {{ @$consultant }}</p>
    <p>Business Name : {{ @$certificate }}</p>
    <p>Payment Received: {{ @$balance }}</p>
    <p>Please Approve This Payment</p>
    {{-- <p><a target="_blank" href="{{ $link }}">Click here to login</a></p> --}}
    <p>{{ @$msg }}</p>
</body>

</html>

@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Cert Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Cert Report</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <form class="row mb-3" action="{{ route('filter.report') }}" method="post">
                        @csrf
                        <div class="col-6">
                            <label>From Date</label>
                            <input type="date" class="form-control" name="from_date">
                        </div>
                        <div class="col-6">
                            <label>To Date</label>
                            <input type="date" class="form-control" name="to_date">
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <hr>
                </div>
            </div>


            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12 " style="width: 100%; overflow-x: scroll;">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>Standerd</th>
                                <th>Business</th>
                                <th>Cert No.</th>
                                <th>CB</th>
                                <th>Salesperson</th>
                                <th>Consultant</th>
                                <th>DOC</th>
                                <th>Scope of Registration</th>
                                <th>Registered Site</th>
                                <th>Payment</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                                {{-- <th>#</th>
                                <th>Standerd</th>
                                <th>Salesperson</th>
                                <th>Business</th>
                                <th>CB</th>
                                <th>Consultant</th>
                                <th>DOC</th>
                                <th>Scope of Registration</th>
                                <th>Registered Site</th>
                                <th>Payment</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                                <th>Cert No.</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$certifications as $certification)
                                <tr>
                                    {{-- <td>{{ $certification->id }}</td> --}}
                                    <td>{{ $certification->standerd }}</td>
                                    <td>{{ $certification->business_name }}</td>
                                    <td>{{ $certification->certificate_number }}</td>

                                    <td>{{ $certification->certificate_template }}</td>
                                    <td>{{ $certification->user->name }}</td>
                                    <td>{{ $certification->consultant->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($certification->created_at)) }}</td>
                                    <td>{{ $certification->scope_registration }}</td>
                                    <td>{{ $certification->registered_site }}</td>
                                    <td>
                                        @foreach ($certification->payments as $payment)
                                            {{ $payment->payment_balance }}
                                            <!-- Display other payment fields as needed -->
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($certification->payments as $payment)
                                            {{ $payment->payment_type }}
                                            <!-- Display other payment fields as needed -->
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($certification->payments as $payment)
                                            {{ $payment->status == 'A' ? 'Approved' : ($payment->status == 'R' ? 'Rejected' : 'pending ') }}
                                            <!-- Display other payment fields as needed -->
                                        @endforeach
                                    </td>
                                    {{-- <td>7981236786123</td> --}}
                                    {{-- <td>{{ $certification->certificate_status }}</td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div><!-- End Left side columns -->
                <!-- Right side columns -->
                <!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
@endsection

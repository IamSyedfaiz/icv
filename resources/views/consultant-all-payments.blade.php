@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>All Payments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Payments</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>

                                <th>Business</th>
                                <th>Certificate No</th>
                                <th>Re-certification Due</th>
                                <th>Payment Received</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>

                                <td>Business name</td>
                                <td>1100124</td>
                                <td>12-3-2026</td>
                                <td>1000</td>
                                <td><a href="preview.html" class="btn-link small">Preview</a></td>

                            </tr> --}}
                            {{-- @foreach ($payments as $payment)
                                {{ $paymentId = $payment->id }}
                                {{ $paymentAmount = $payment->amount }}
                                -
                                {{ $userName = $payment->user->name }}
                                {{ $userParentId = $payment->user->parent_id }}
                                -
                                {{ $userParentName = $payment->user->parent->name }}
                            @endforeach --}}
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ @$payment->consultant->business_name }}</td>
                                    <td>LK Pvt Ltd</td>
                                    <td> {{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                                    <td>{{ $payment->payment_balance }}</td>
                                    <td>{{ $payment->status == 'A' ? 'Approved' : ($payment->status == 'R' ? 'Rejected' : 'pending ') }}
                                    </td>
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

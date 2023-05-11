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

                                <th>Salesperson</th>

                                <th>Consultant</th>
                                <th>Payment Received</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($payments as $payment)
                                <tr>
                                    <td> {{ $paymentId = $payment->id }}</td>
                                    <td> {{ $userName = $payment->user->name }}</td>
                                    <td> {{ $userParentId = $payment->user->parent_id }}</td>
                                    <td> {{ $userParentName = $payment->user->parent->name }}</td>
                                </tr>
                            @endforeach --}}
                            @foreach ($payments as $payment)
                                @if ($payment->user->parent_id == auth()->user()->id)
                                    <tr>
                                        <td>{{ @$payment->consultant->name }}</td>
                                        <td>LK Pvt Ltd</td>
                                        <td>{{ $payment->payment_balance }}</td>
                                        <td>{{ $payment->payment_type }}</td>
                                        <td>{{ date('Y-m-d', strtotime($payment->created_at)) }}</td>
                                        @if ($payment->status == 'A')
                                            <td>Approved</td>
                                        @elseif ($payment->status == 'R')
                                            <td>Rejected</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <div class="d-flex">
                                                <form
                                                    action="{{ route('approved.payment', ['id' => $payment->id, 'certficate_id' => $payment->certificate_id]) }}"
                                                    {{-- action="{{ route('approved.payment', ['id' => $payment->id, 'certficate_id' => $payment->certificate_id]) }}" --}}
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link small">Approve</button>
                                                </form>
                                                <span class="mx-2 mt-2">|</span>
                                                <form action="{{ route('rejected.payment', ['id' => $payment->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link small ">Reject</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endif
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

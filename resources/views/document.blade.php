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
                                <th>Business Name</th>
                                <th>Certificate Status</th>
                                <th>Date</th>
                                <th>File Name</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->certification->user->name }}</td>
                                    <td>{{ $document->certification->consultant->name }}</td>
                                    <td>{{ $document->certification->business_name }}</td>
                                    <td>{{ $document->certification->certificate_status }}</td>
                                    <td>{{ date('Y-m-d', strtotime($document->created_at)) }}</td>
                                    <td>{{ $document->file_name }}</td>
                                    <td><a target="_blank"
                                            href="{{ $document->getMedia('post_image')->first()->getUrl() }}">View</a></td>
                                    @if ($document->certification->status == 'A')
                                        <td>Approved</td>
                                    @elseif ($document->certification->status == 'R')
                                        <td>Rejected</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        <div class="d-flex">
                                            <form
                                                action="{{ route('approved.document', ['id' => $document->certification->id]) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-link small">Approve</button>
                                            </form>
                                            <span class="mx-2 mt-2">|</span>
                                            <form
                                                action="{{ route('rejected.document', ['id' => $document->certification->id]) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-link small ">Reject</button>
                                            </form>
                                        </div>
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

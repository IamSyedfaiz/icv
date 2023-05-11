@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>All Consultants</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Consultants</li>
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
                                <th>Name</th>
                                <th>Business</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$consultants as $consultant)
                                <tr>
                                    <td>{{ $consultant->name }}</td>
                                    <td>{{ $consultant->business_name }}</td>
                                    <td>{{ $consultant->address }}</td>
                                    <td>{{ $consultant->phone }}</td>
                                    <td>{{ $consultant->email }}</td>
                                    <td>Active</td>
                                    <td><a href="{{ route('consultant', $consultant->id) }}" class="btn-link small">View</a>
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

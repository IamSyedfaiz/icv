@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>All Certs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Certs</li>
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
                                <th>#</th>
                                <th>Business</th>
                                <th>CB</th>
                                <th>Consultant</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$certifications as $certification)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! @$certification->business_name !!}</td>
                                    <td>{{ @$certification->certificate_template }}</td>
                                    <td>{{ @$certification->consultant->name }}</td>
                                    <td>{{ @$certification->certificate_status }}</td>

                                    <td>
                                        {{-- <a href="preview.html" class="btn-link small">Preview</a> | --}}
                                        <a href="{{ route('edit.draft.cert', $certification->id) }}"
                                            class="btn-link small">Edit</a> |
                                        <a href="{{ route('delete.certificate', $certification->id) }}"
                                            class="btn-link small">Delete</a>
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

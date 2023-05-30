@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add Certificate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Add Certificate</li>
                </ol>
            </nav>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Certificate details - @if ($consultants instanceof \Illuminate\Support\Collection || is_array($consultants))
                                    Consultant name
                                @else
                                    {{ @$consultants->name }}
                                @endif
                            </h5>
                            <form class="row g-3" action="{{ route('store.draft.cert') }}" method="post">
                                @csrf
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->

                                <div class="col-12 col-lg-6">
                                    <label for="cat" class="form-label">Certificate Template</label>
                                    <input type="text" name="consultant_id" class="form-control" id="cat"
                                        value="{{ @$consultants->id }}" hidden>
                                    <select class="form-control" name="certificate_template">
                                        <option value="">Select</option>
                                        <option value="ici">ICI</option>
                                        <option value="icv">ICV</option>
                                        <option value="star">Star</option>
                                    </select>
                                    @error('certificate_template')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="cat" class="form-label">Certificate Status</label>
                                    <select class="form-control" name="certificate_status">
                                        <option>Draft</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="cat" class="form-label">Standerd</label>
                                    <input type="text" name="standerd" class="form-control" id="cat">
                                </div>
                                <div class="col-12">
                                    <label for="cat" class="form-label">Business Name</label>
                                    {{-- <input type="text" name="business_name" class="form-control" id="cat"> --}}
                                    <textarea class="form-control" name="business_name"></textarea>

                                </div>

                                <div class="col-12">
                                    <label for="subcat" class="form-label">Scope of Registration</label>
                                    <textarea class="form-control" name="scope_registration"></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="product" class="form-label">Registered Site(s)</label>
                                    <textarea class="form-control" name="registered_site"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
                <!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
@endsection

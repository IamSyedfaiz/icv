@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add Consultant</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Add Consultant</li>
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
                            <h5 class="card-title">Consultant details</h5>
                            <form class="row g-3" method="POST" action="{{ route('create.consultant') }}">
                                @csrf
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="cat" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="cat" name="c_name"
                                        value="{{ old('c_name') }}" required>
                                </div>
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="subcat" class="form-label">Business Name</label>
                                    <input type="text" class="form-control" id="subcat" name="c_business_name"
                                        value="{{ old('c_business_name') }}" required>
                                </div>
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="product" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="product" name="c_address"
                                        value="{{ old('c_address') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="refno" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="refno" name="phone"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="c_email"
                                        value="{{ old('c_email') }}" required>
                                    @error('c_email')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
                <!-- Right side columns -->

                <!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
@endsection

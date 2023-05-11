@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Consultant Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Consultant Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Certificate Drafts</h5>
                            <h1>17</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Certificate Final</h5>
                            <h1>6</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Consultant details</h5>
                            <form class="row g-3">
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="cat" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="cat"
                                        value="{{ $consultant->name }}" disabled>
                                </div>
                                {{-- <div class="col-6">
                                    <label for="cat" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="cat" disabled>
                                </div> --}}
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="subcat" class="form-label">Business Name</label>
                                    <input type="text" class="form-control" id="subcat"
                                        value="{{ $consultant->business_name }}" disabled>
                                </div>
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="product" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="product"
                                        value="{{ $consultant->address }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="refno" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="refno"
                                        value="{{ $consultant->phone }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        value="{{ $consultant->email }}" disabled>
                                </div>


                                <div class="text-center">
                                    <a href="{{ route('add.draft.cert', ['id' => $consultant->id]) }}"
                                        class="btn btn-primary">Create
                                        Certificate
                                        Draft</a>
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

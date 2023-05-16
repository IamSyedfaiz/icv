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
                                    <textarea class="form-control" id="editor1" name="business_name"></textarea>

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
                {{-- <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Documents</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-edit">Payment</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Final
                                        Certificate</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                    <h5 class="card-title">Documents</h5>

                                    <form method="post" action="{{ route('upload.document') }}"
                                        enctype="multipart/form-data">
                                        @csrf


                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">File
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="file_name" type="text" class="form-control" id="fullName"
                                                    value="Legal">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Upload
                                                File</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="file" name="file" class="form-control" id="">
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                    <hr>
                                    <table class="table">
                                        <tr>
                                            <th>Particulars</th>
                                            <th>Document</th>
                                            <th>Upload Date</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($documents as $document)
                                            <tr>
                                                <td>{{ $document->file_name }}</td>
                                                <td>{{ @$document->getMedia('post_image')->first()->file_name }}</td>
                                                <td>{{ date('Y-m-d', strtotime($document->created_at)) }}</td>
                                                <td><a target="_blank"
                                                        href="{{ @$document->getMedia('post_image')->first()->getUrl() }}">View</a>
                                                    | <a
                                                        href="{{ route('delete.document', ['id' => $document->id]) }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form class="row g-3" action="{{ route('upload.payment') }}" method="post">
                                        @csrf
                                        <div class="col-12 mb-3">
                                            <label for="cat" class="form-label">Payment Received</label>
                                            <select class="form-control" name="payment_type">
                                                <option>Select</option>
                                                <option>Paytm</option>
                                                <option>Gpay</option>
                                                <option>Phonepay</option>
                                                <option>B. Account</option>
                                                <option>P. Account</option>
                                                <option>Cash</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="cat" class="form-label">Amount</label>
                                            <input type="text" class="form-control" name="payment_balance"
                                                id="cat">
                                        </div>
                                        <input type="text" name="consultant_id" value="{{ @$consultants->id }}"
                                            hidden>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>

                                        </div>

                                    </form>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <form class="row g-3" action="preview.html" method="post">

                                        <div class="col-12">
                                            <label for="refno" class="form-label">Certificate No</label>
                                            <input type="text" class="form-control" value="AD-001" id="refno"
                                                placeholder="format required from client" name="certificate_number"
                                                disabled readonly>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="email" class="form-label">Date of initial registration</label>
                                            <input type="text" class="form-control"
                                                value="{{ $format_current_date }}" id="email"
                                                name="date_registration" disabled readonly>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="email" class="form-label">First Surveillance Audit on or
                                                before</label>
                                            <input type="text" class="form-control" value="{{ $format_first_date }}"
                                                id="email" name="first_surveillance_audit" disabled readonly>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="email" class="form-label">Second Surveillance Audit on or
                                                before</label>
                                            <input type="text" class="form-control" value="{{ $format_second_date }}"
                                                id="email" name="second_surveillance_audit" disabled readonly>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <label for="email" class="form-label">Re-certification Due</label>
                                            <input type="text" class="form-control" value="{{ $format_due_date }}"
                                                id="email" name="certification_due_date" disabled readonly>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Generate Final Cert</button>
                                        </div>




                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div> --}}
                <!-- Right side columns -->

                <!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection

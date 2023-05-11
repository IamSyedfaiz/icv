@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Add User</li>
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

                            <h5 class="card-title">User details</h5>
                            <form class="row g-3" method="POST" action="{{ route('create.user') }}">
                                @csrf
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="cat" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="cat" name="uname"
                                        value="{{ old('uname') }}" required>
                                </div>
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->

                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="refno" class="form-label">Phone</label>
                                    <input type="number" class="form-control" id="refno" name="uphone"
                                        value="{{ old('uphone') }}" required>
                                    @error('uphone')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="refno" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="refno" name="upassword"
                                        value="{{ old('upassword') }}" required>
                                    @error('upassword')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="uemail"
                                        value="{{ old('uemail') }}" required>
                                    @error('uemail')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">User Role</label>
                                    <select class="form-control" name="urole">
                                        <option value="">select</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                    @error('urole')
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

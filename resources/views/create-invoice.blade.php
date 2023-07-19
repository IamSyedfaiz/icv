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
                            <h5 class="card-title">Create Invoice</h5>
                            <form class="row g-3" method="POST" action="{{ route('store.invoice') }}">
                                @csrf
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="cat" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="cat" name="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" required>
                                </div>
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="subcat" class="form-label">GST number</label>
                                    <input type="text" class="form-control" id="subcat" name="gst_number"
                                        value="{{ old('gst_number') }}" required>
                                </div>
                                <!-- Use auto complete js https://jqueryui.com/autocomplete/ -->
                                <div class="col-12">
                                    <label for="product" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="product" name="address"
                                        value="{{ old('address') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="refno" class="form-label">Invoice Number</label>
                                    <input type="number" class="form-control" id="refno" name="invoice_number"
                                        value="{{ old('invoice_number') }}" required>
                                    @error('invoice_number')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Item Number</label>
                                    <input type="number" class="form-control" id="email" name="item_number"
                                        value="{{ old('item_number') }}" required>
                                    @error('item_number')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="email" name="amount"
                                        value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="tax" class="form-label">Tax</label>
                                    <input type="number" class="form-control" id="tax" name="tax"
                                        value="{{ old('tax') }}" required>
                                    @error('tax')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Select Quantity</label>
                                    <input type="number" class="form-control" id="email" name="quantity"
                                        value="{{ old('quantity') }}" required>
                                    @error('quantity')
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

@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>All Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">All Users</li>
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
                                <th>Salesperson</th>
                                {{-- <th>Consultants</th> --}}
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    {{-- <td>8A / 10I</td> --}}
                                    <td>{{ $user->getRoleNames()->first() }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{-- <td><a href="#" class="btn-primary btn">Suspend</a></td> --}}
                                    <td>
                                        @if (@$user->active !== 'Y')
                                            <form
                                                action="{{ route('change.active', ['id' => $user->id, 'status' => 'Y']) }}"
                                                method="post" class="inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <span>Suspended</span>
                                                    <i class="fas fa-user-slash "></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if (@$user->active !== 'N')
                                            <form
                                                action="{{ route('change.active', ['id' => $user->id, 'status' => 'N']) }}"
                                                method="post" class="inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    <span>Active</span>
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                            </form>
                                        @endif
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

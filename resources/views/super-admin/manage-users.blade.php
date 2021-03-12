@extends('layouts.backend-super-admin')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/oneui.core.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Code -->
    <script src="{{ asset('js/oneui.core.min.js') }}"></script>
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Manager Users
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Management</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Manage Users</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block">
            <div class="block-content">
                <div class="block">               

                    <div class="card-box">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="block-content"> 
                        <div class="row items-push">
                            <div class="col-lg-4">
                                {{-- <p class="font-size-sm text-muted">
                                    Select the session and term you would like to view result
                                </p> --}}
                            </div>

                            <div class="col-lg-8 col-xl-5 text-center">
                                <a href="{{ route('manage-admin-superadmin') }}" class="list-group-item list-group-item-action list-group-item-warning">Add Admin</a>
                                <br><br>
                                <a href="{{ route('manage-admin-superadmin') }}" class="list-group-item list-group-item-action list-group-item-info">Manage Admin</a>
                                <a href="{{ route('manage-data-operator-superadmin') }}" class="list-group-item list-group-item-action list-group-item-secondary">Manage DataOperator</a>
                                <a href="{{ route('manage-teacher-superadmin') }}" class="list-group-item list-group-item-action list-group-item-success">Manage Teachers</a>
                                <a href="{{ route('manage-student-superadmin') }}" class="list-group-item list-group-item-action list-group-item-primary">Manage Student</a>
                            </div>                 
                        </div>
                    </div>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

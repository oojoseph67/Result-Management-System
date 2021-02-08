@extends('layouts.backend-data-operator')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/oneui.core.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/oneui.core.min.js') }}"></script>
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Manage <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Users</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">School Management</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Manage User</a>
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
            <div class="block-header">
                <h3 class="block-title">Manage Users</h3>
            </div>
            <div class="block-content">
                {{-- <p class="font-size-sm text-muted">
                    Your content..
                </p> --}}

                 <!-- Errror Code -->
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

                    @if ($errors->has('password'))                                 
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- END Of Errror Code -->

                <div class="block">
                    <div class="block-header"> 
                        <h3 class="block-title"> </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-settings"></i>
                                </button>
                            </div>
                    </div>                    

                    <div class="block-content"> 
                        <div class="row items-push">
                            <div class="col-lg-8 col-xl-5">
                                <h4><a href="{{ route('manage-data-operator') }}">Data Operator</a></h4>
                
                                <h4><a href="{{ route('manage-teacher') }}">Teacher</a></h4>
                
                                <h4><a href="{{ route('manage-student') }}">Student</a></h4>
                            </div>                            
                        </div>

                        <div class="col-lg-8 col-xl-5">
                            <h4><a href="{{ route('add-data-operator') }}">Add Data Operator</a></h4>
            
                            <h4><a href="{{ route('add-teacher') }}">Add Teacher</a></h4>
            
                            <h4><a href="{{ route('add-student') }}">Add Student</a></h4>
                        </div>
                       
                    </div>


                </div>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

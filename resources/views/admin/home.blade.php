@extends('layouts.backend-admin')

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
                {{-- <h1 class="flex-sm-fill h3 my-2">
                    Dashboard
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </nav> --}}
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block">
            <div class="block-content">
               <!-- Main Container -->
                <main id="main-container">
                    <!-- Hero -->
                        <div class="bg-image" style="background-image: url({{asset('media/photos/photo3@2x.jpg')}});">
                            <div class="bg-black-75">
                                <div class="content content-full text-center"> 
                                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                                        <div class="flex-sm-fill">
                                            <h1 class="font-w600 text-white mb-0">Dashboard</h1>
                                            <h2 class="h4 font-w400 text-white-75 mb-0">Welcome {{ Auth::user()->name }}</h2>
                                        </div>
                                        {{-- <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                                            <span class="d-inline-block">
                                                <a class="btn btn-primary px-4 py-2" href="javascript:void(0)">
                                                    <i class="fa fa-plus mr-1"></i> New Project
                                                </a>
                                            </span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Hero -->

                    <!-- Page Content -->
                        <div class="content content-narrow">
                            <!-- Profile and Session Management -->
                                <div class="row row-deck">
                                    <!-- Prorfile Information  -->
                                    <div class="col-lg-6">
                                        <div class="block block-mode-loading-oneui">
                                            <div class="block-header block-header-default">
                                                <h3 class="block-title">Profile Management</h3>
                                            </div>
                                            <div class="block-content block-content-full">
                                                <div class="list-group text-center">      
                                                    <a href="{{ route('manage-data-operator') }}" class="list-group-item list-group-item-action list-group-item-secondary">Add DataOperator</a>
                                                    <br><br>
                                                    <a href="{{ route('manage-teacher') }}" class="list-group-item list-group-item-action list-group-item-success">Add Teacher</a>
                                                    <br><br>
                                                    <a href="{{ route('manage-student') }}" class="list-group-item list-group-item-action list-group-item-primary">Add Student</a>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Latest Customers -->

                                    <!-- Current Results -->
                                    <div class="col-lg-6">
                                        <div class="block block-mode-loading-oneui">
                                            <div class="block-header block-header-default">
                                                <h3 class="block-title">Subject Management</h3>
                                            </div>
                                            <div class="block-content block-content-full">
                                               <div class="list-group text-center">      
                                                    <br><br>
                                                    <a href="{{ route('create-subject') }}" class="list-group-item list-group-item-action list-group-item-info">Create Subject</a>
                                                    <br><br>
                                                    <a href="{{ route('assign-teacher') }}" class="list-group-item list-group-item-action list-group-item-warning">Assign Teacher</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Latest Orders -->
                                </div>
                            <!-- END Customers and Latest Orders -->
                        </div>
                    <!-- END Page Content -->

                </main>                
                <!-- END Main Container -->
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

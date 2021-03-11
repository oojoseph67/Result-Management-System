@extends('layouts.backend-student')

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
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Previous Results</a>
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
                <h3 class="block-title">Previous Result</h3>
            </div>
            <div class="block-content">
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

                
               <form action="{{ route('previous-result-action') }}" method="POST" target="_blank">
                   @csrf

                    <div class="row items-push">
                        <div class="col-lg-4">
                            <p class="font-size-sm text-muted">
                                Select the session and term you would like to view result
                            </p>
                        </div>

                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label for="session">Select Class <span class="text-danger">*</span></label>
                                <select class="form-control" name="class" required>
                                    <option value="">Please select</option>
                                    @if( count($class)>0 ) 
                                        @foreach($class->all() as $class_view)
                                            <option value="{{$class_view->class}}">{{$class_view->class}}</option>
                                        @endforeach
                                    @endif 
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="session">Select Session <span class="text-danger">*</span></label>
                                <select class="form-control" name="session" required>
                                    <option value="">Please select</option>
                                    @if( count($session)>0 ) 
                                        @foreach($session->all() as $session_view)
                                            <option value="{{$session_view->session}}">{{$session_view->session}}</option>
                                        @endforeach
                                    @endif 
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="term">Select Term <span class="text-danger">*</span></label>
                                <select class="form-control" name="term" required>
                                    <option value="">Please select</option>
                                    <option value="1st">First Term</option>
                                    <option value="2nd">Second Term</option>
                                    <option value="3rd">Third Term</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-success">
                                    See Session Result
                                </button>
                            </div>
                        </div>                 
                    </div>
               </form>

            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

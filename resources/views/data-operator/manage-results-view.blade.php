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
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Manage Result
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">School Management</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Manage Result</a>
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

                
                <!-- Manage Result -->
                    <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
                    <form action="{{ route('manage-results-class-dop') }}" method="">
                        @csrf
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <p class="font-size-sm text-muted">
                                   Select the particular class you will like to manage student result.
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                {{-- <div class="form-group">
                                    <label for="val-skill">Select Subject <span class="text-danger">*</span></label>
                                    <select class="form-control" name="subject_name" required>
                                        <option value="">Please select</option>
                                        @if( count($subject_data)>0 ) 
                                            @foreach($subject_data->all() as $subject_view)
                                                <option value="{{$subject_view->subject_name}}">{{$subject_view->subject_name}}</option>
                                            @endforeach
                                        @endif 
                                    </select>
                                </div> --}}
                                 <div class="form-group">
                                    <label for="val-skill">Select Class <span class="text-danger">*</span></label>
                                    <select class="form-control" name="class" required>
                                        <option value="">Please select</option>
                                        @if( count($class_data)>0 ) 
                                            @foreach($class_data->all() as $class_view)
                                                <option value="{{$class_view->class}}">{{$class_view->class}}</option>
                                            @endforeach
                                        @endif 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">
                                        <i class="fa fa-fw fa-plus mr-1"></i> Manage Class Result
                                    </button>
                                </div>
                            </div>                    
                        </div>
                    </form>
                <!-- END Manage Result -->


                 <!-- Full Table -->
                 <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">List Of Student For {{$class}} </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 100px;">
                                            <i class="far fa-user"></i>
                                        </th>
                                        <th>Name</th>
                                        <th style="width: 30%;">Class</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr>
                                            <td class="text-center">
                                                <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                            </td>
                                            <td class="font-w600 font-size-sm">
                                                <a href="">{{ $users->name }}</a>
                                            </td>
                                            <td class="font-size-sm"><em class="text-muted">{{ $users->current_class }}</em></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-secondary push" href="/dop/single-result/{{$users->current_class}}/{{$users->name}}">Edit</a>
                                                    {{-- <a class="btn btn-sm btn-secondary push" href="{{ route('single-result', $users->id,$user->name) }}">Edit</a> --}}
                                                    {{-- <button type="button" class="btn btn-sm btn-danger push" data-toggle="modal" data-target="#delete{{ $data->id }}" title="Delete">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!-- END Full Table -->


            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

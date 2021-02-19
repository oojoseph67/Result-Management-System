@extends('layouts.backend-admin')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
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

    <!-- Page JS Helpers (Select2 plugin) -->
    <script>jQuery(function(){ One.helpers('select2'); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Subject Management <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Assign Teacher</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Subject Management</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Assign Page</a>
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
                <h3 class="block-title">Assign Teacher</h3>
            </div>
            <div class="block-content">
                {{-- <p class="font-size-sm text-muted">
                    Your content..
                </p> --}}

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

                <!-- Assign Teacher -->
                    <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
                    <form action="{{ route('assign-action') }}" method="POST">
                        @csrf
                        <div class="row items-push">
                            <div class="col-lg-4">
                                {{-- <p class="font-size-sm text-muted">
                                    You can easily validate any kind of data you like either it is in a normal input, a textarea or a select box
                                </p> --}}
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="form-group">
                                    <label for="teacher">Select Teacher<span class="text-danger">*</span></label>
                                    <select id="class" class="js-select2 form-control" id="val-select2" name="teacher" required>
                                        <option value="">Please select</option>
                                        @if( count($teacher)>0 ) 
                                            @foreach($teacher->all() as $teacher)
                                                <option value="{{$teacher->name}}">{{$teacher->name}}</option>
                                            @endforeach
                                        @endif 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Select Subject <span class="text-danger">*</span></label>
                                    <select id="subject" class="js-select2 form-control" id="val-select2" name="subject" required>
                                        <option value="">Please select</option>
                                        @if( count($subject_data)>0 ) 
                                            @foreach($subject_data->all() as $subject_view)
                                                <option value="{{$subject_view->subject_name}}">{{$subject_view->subject_name}}</option>
                                            @endforeach
                                        @endif 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="class">Select Class <span class="text-danger">*</span></label>
                                    <select id="class" class="js-select2 form-control" id="val-select2" name="class" required>
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
                                        <i class="fa fa-fw fa-plus mr-1"></i> Assign Teacher
                                    </button>
                                </div>
                            </div>                    
                        </div>
                    </form>
                <!-- END Assign Teacher -->

                 <!-- Assigned Teachers -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">List Of Assigned Teacher To Subject And Class</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">ID</th>
                                        <th>Teacher Name</th>
                                        <th class="d-none d-sm-table-cell" style="width: 30%;">Subject Name</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Class</th>
                                        <th style="width: 15%;">Delete Assignment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assigned as $assigned)
                                        <tr>
                                            <td class="text-center font-size-sm">1</td>
                                            <td class="font-w600 font-size-sm">
                                                <a href="#">{{$assigned->teacher_name}}</a>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-size-sm">
                                                {{$assigned->subject_name}}
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                {{$assigned->class}}
                                                {{-- <span class="badge badge-danger">Disabled</span> --}}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                <div class="btn-group">
                                                        {{-- <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#edit{{ $assigned->id }}" title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button> --}}
                                                        <button type="button" class="btn btn-sm btn-danger push" data-toggle="modal" data-target="#delete{{ $assigned->id }}" title="Delete">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Edit Block Modal -->                                                
                                            {{-- <div class="modal" id="edit{{ $assigned->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
                                                <div class="modal-dialog modal-sm-6" role="document">
                                                    <div class="modal-content">
                                                        <div class="block block-themed block-transparent mb-0">
                                                            <div class="block-header bg-primary-dark">
                                                                <h3 class="block-title">Edit Assigned Teacher</h3>
                                                                <div class="block-options">
                                                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                        <i class="fa fa-fw fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="block-content font-size-sm">
                                                                <form action="{{ route('update-assign') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                                    <div class="col-lg-8 col-xl-5">
                                                                        <div class="form-group">
                                                                            <label for="subject_name">Subject Name <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="subject_name" value="{{$data->subject_name}}" autocomplete="off"  name="subject_name" placeholder="Input Subject Name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Select Class <span class="text-danger">*</span></label>
                                                                            <select class="form-control" name="class" required>
                                                                                <option value="{{$data->class}}">{{$data->class}}</option>
                                                                                @if( count($class_data)>0 ) 
                                                                                    @foreach($class_data->all() as $class_view)
                                                                                        <option value="{{$class_view->class}}">{{$class_view->class}}</option>
                                                                                    @endforeach
                                                                                @endif 
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-block btn-success">
                                                                                <i class="fa fa-fw fa-plus mr-1"></i> Update Subject
                                                                            </button>
                                                                        </div>
                                                                    </div>           
                                                                </form>
                                                            </div>
                                                            <div class="block-content block-content-full text-right border-top">
                                                                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        <!-- END Edit Block Modal -->

                                    <!-- Delete Block Modal -->
                                        <div class="modal" id="delete{{$assigned->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-danger">
                                                            <h3 class="block-title">Tobias Title</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                    <i class="fa fa-fw fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="block-content font-size-sm">
                                                            <p>
                                                                Are You Sure You Want To Delete This Assignment 
                                                                <br>
                                                                Teacher: <b>{{$assigned->teacher_name}}</b>
                                                                <br>
                                                                Subject: <b>{{$assigned->subject_name}}</b>
                                                                <br>
                                                                Class: <b>{{$assigned->class}}</b>
                                                            </p>
                                                            <form action="{{ route('delete-assign') }}">
                                                                <input type="hidden" name="id" value="{{$assigned->id}}">
                                                                <input type="hidden" name="subject_name" value="{{$assigned->subject_name}}">
                                                                <input type="hidden" name="teacher_name" value="{{$assigned->teacher_name}}">
                                                                <input type="hidden" name="class" value="{{$assigned->class}}">
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-block btn-danger">
                                                                        <i class="fa fa-fw fa-times mr-1"></i> Delete Assignment
                                                                    </button>
                                                                </div> 
                                                            </form>
                                                            
                                                        </div>
                                                        <div class="block-content block-content-full text-right border-top">
                                                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                                            {{-- <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- END Delete Block Modal -->
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- END Assigned Teachers -->


            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

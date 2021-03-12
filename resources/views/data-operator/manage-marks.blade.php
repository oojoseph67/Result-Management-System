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
                    Manage Marks
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">School Management</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{ route('manage-marks-dop') }}">Manage Marks</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Manage Class Marks</a>
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

                <!-- Full Table -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">List Of Student For {{$class}} For Subject {{$subject_name}}</h3>
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
                                            <th style="width: 15%;">Subject</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $data)
                                            <tr>
                                                <td class="text-center">
                                                    <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                                </td>
                                                <td class="font-w600 font-size-sm">
                                                    <a href="">{{ $data->name }}</a>
                                                </td>
                                                <td class="font-size-sm"><em class="text-muted">{{ $data->current_class }}</em></td>
                                                <td>
                                                    <span class="badge badge-primary">{{$subject_name}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#edit{{ $data->id }}" title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        {{-- <button type="button" class="btn btn-sm btn-danger push" data-toggle="modal" data-target="#delete{{ $data->id }}" title="Delete">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button> --}}
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Edit Block Modal -->                                                
                                                <div class="modal" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm-6" role="document">
                                                        <div class="modal-content">
                                                            <div class="block block-themed block-transparent mb-0">
                                                                <div class="block-header bg-primary-dark">
                                                                    <h3 class="block-title">Edit Marks</h3>
                                                                    <div class="block-options">
                                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-fw fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content font-size-sm">
                                                                    <form action="{{ route('edit-marks-dop') }}" method="POST">
                                                                        @csrf
                                                                        <div class="py-3">
                                                                            <h4 class="bolck-title danger">Total score will update after the subjects column has been updated</h4>
                                                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                                                            <input type="hidden" name="class" value="{{$class}}">
                                                                            <input type="hidden" name="subject_name" value="{{$subject_name}}">
                                                                            <input type="hidden" name="student_name" value="{{ $data->name }}">
                                                                            
                                                                            @if (DB::table('results')->where('name', $data->name)->where('subject_name', $subject_name)->exists())
                                                                                @foreach ($result as $result_data)
                                                                                    @if ($result_data->name == $data->name)
                                                                                        @if ($result_data->subject_name == $subject_name)
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> Attendance Score <span class="text-danger">*</span> <span class="text-danger"><em> Highest Point Is 5</em></span></label>
                                                                                                <input type="number" name="attendance_score" class="form-control" value="{{$result_data->attendance_score}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> 1st Test <span class="text-danger">*</span> <span class="text-danger"><em> Highest Point Is 10</em></span></label>
                                                                                                <input type="number" name="first_test" class="form-control" value="{{$result_data->first_test}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> 2nd Test <span class="text-danger">*</span> <span class="text-danger"><em> Highest Point Is 10</em></span></label>
                                                                                                <input type="number" name="second_test" class="form-control" value="{{$result_data->second_test}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> 3rd Test <span class="text-danger">*</span> <span class="text-danger"><em> Highest Point Is 10</em></span></label>
                                                                                                <input type="number" name="third_test" class="form-control" value="{{$result_data->third_test}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> Quiz <span class="text-danger">*</span> <span class="text-danger"><em> Highest Value Is 5</em></span></label>
                                                                                                <input type="number" name="quiz" class="form-control" value="{{$result_data->quiz}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> Exam Score<span class="text-danger">*</span> <span class="text-danger"><em> Highest Point Is 60</em></span></label>
                                                                                                <input type="number" name="exam_score" class="form-control" value="{{$result_data->exam_score}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="subject"> Total <small>Total score shows here</small><span class="text-danger">*</span> <span class="text-danger"><em> Total score is over 100</em></span></label>
                                                                                                <input type="number" name="total" disabled placeholder="Total score is over 100" class="form-control" value="{{$result_data->total}}">
                                                                                            </div>
                                                                                        @endif                                                                                        
                                                                                    @endif                                                                               
                                                                                @endforeach
                                                                            @else
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Attendance Score <span class="text-danger">*</span> <span class="text-danger"> <em> Highest Point Is 5</em></span></label>
                                                                                    <input type="number" name="attendance_score" class="form-control" value="{{old('attendance_score')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 1st Test <span class="text-danger">*</span> <span class="text-danger"> <em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="first_test" class="form-control" value="{{old('first_test')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 2nd Test <span class="text-danger">*</span> <span class="text-danger"> <em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="second_test" class="form-control" value="{{old('second_test')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 3rd Test <span class="text-danger">*</span> <span class="text-danger"> <em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="third_test" class="form-control" value="{{old('third_test')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Quiz <span class="text-danger">*</span> <span class="text-danger"> <em> Highest Point Is 5</em></span></label>
                                                                                    <input type="number" name="quiz" class="form-control" value="{{old('quiz')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Exam Score<span class="text-danger">*</span> <span class="text-danger"> <em> Highest Point Is 60</em></span></label>
                                                                                    <input type="number" name="exam_score" class="form-control" value="{{old('exam_score')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Total <span class="text-danger">*</span></label>
                                                                                    <input type="number" name="total" disabled placeholder="Total score is over 100" class="form-control">
                                                                                </div>
                                                                            @endif
                                                                            
                                                                           
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-md-6 col-xl-5">
                                                                                <button type="submit" class="btn btn-block btn-success">
                                                                                    <i class="fa fa-fw fa-plus mr-1"></i> Update Marks
                                                                                </button>
                                                                            </div>
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
                                            <!-- END Edit Block Modal -->
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

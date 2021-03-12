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
                            <a class="link-fx" href="{{ route('manage-results-dop') }}">Manage Result</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Manage <i>{{$name}}</i> Result</a>
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
                            <h3 class="block-title"><small>{{$name}} </small> Result</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-settings"></i>
                                </button>
                            </div>
                        </div>
                        <h1 class="text-center">
                            <span class="font-w600 font-size-sm">{{$name}}</span>
                            <br>
                            <img class="img-avatar img-avatar59" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                            <br>
                            <span class="font-w600 font-size-sm">
                                Session : {{Auth::user()->session}}
                            </span>
                            <br>
                            <span class="font-w600 font-size-sm">
                                Term : {{Auth::user()->term}}
                            </span>
                            <br>
                            <span class="font-w600 font-size-sm">
                                Class Average : {{$class_avg}}
                            </span>
                            <span class="font-w600 font-size-sm">
                                Total In Class : {{$total_in_class}}
                            </span>
                            <br>
                            <span class="font-w600 font-size-sm">
                                {{$name}} Average : {{$user_avg}}
                            </span>
                            <form action="{{ route('print-result-dop') }}">
                                @csrf
                                <input type="hidden" name="name" value="{{$name}}">
                                <input type="hidden" name="class" value="{{$class}}">
                                <div class="form-group row">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            <i class="fa fa-fw fa-plus mr-1"></i> Proceed To Print
                                        </button>
                                </div>
                            </form>
                            {{-- <div class="form-group row">
                                <div class="col-md-6 col-xl-5">
                                    <button onclick="window.print()" class="btn btn-block btn-primary">
                                        <i class="fa fa-fw fa-plus mr-1"></i> Print
                                    </button>
                                </div>
                            </div> --}}
                        </h1>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%;">Class</th>
                                            <th style="width: 15%;">Subject</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($result as $data)
                                            <tr>
                                                <td class="font-size-sm"><em class="text-muted">{{ $data->class }}</em></td>
                                                <td>
                                                    <span class="badge badge-secondary">{{ $data->subject_name }}</span>
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
                                                                            <input type="hidden" name="subject_name" value="{{$data->subject_name}}">
                                                                            <input type="hidden" name="student_name" value="{{ $data->name }}">
                                                                            
                                                                            @if (DB::table('results')->where('name', $data->name)->where('subject_name', $data->subject_name)->exists())                                                                              
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Attendance Score <span class="text-danger">*</span><em> Highest Point Is 5</em></span></label>
                                                                                    <input type="number" name="attendance_score" class="form-control" value="{{$data->attendance_score}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 1st Test <span class="text-danger">*</span><em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="first_test" class="form-control" value="{{$data->first_test}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 2nd Test <span class="text-danger">*</span><em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="second_test" class="form-control" value="{{$data->second_test}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 3rd Test <span class="text-danger">*</span><em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="third_test" class="form-control" value="{{$data->third_test}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Quiz <span class="text-danger">*</span><em> Highest Point Is 5</em></span></label>
                                                                                    <input type="number" name="quiz" class="form-control" value="{{$data->quiz}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Exam Score<span class="text-danger">*</span><em> Highest Point Is 60</em></span></label>
                                                                                    <input type="number" name="exam_score" class="form-control" value="{{$data->exam_score}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Total <small>Total score shows here</small><span class="text-danger">*</span><em> Total score is over 100</em></span></label>
                                                                                    <input type="number" name="total" disabled placeholder="Total score is over 100" class="form-control" value="{{$data->total}}">
                                                                                </div>                                                                                    
                                                                            @else
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Attendance Score <span class="text-danger">*</span><em> Highest Point Is 5</em></span></label>
                                                                                    <input type="number" name="attendance_score" class="form-control" value="{{old('attendance_score')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 1st Test <span class="text-danger">*</span><em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="first_test" class="form-control" value="{{old('first_test')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 2nd Test <span class="text-danger">*</span><em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="second_test" class="form-control" value="{{old('second_test')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> 3rd Test <span class="text-danger">*</span><em> Highest Point Is 10</em></span></label>
                                                                                    <input type="number" name="third_test" class="form-control" value="{{old('third_test')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Quiz <span class="text-danger">*</span><em> Highest Point Is 5</em></span></label>
                                                                                    <input type="number" name="quiz" class="form-control" value="{{old('quiz')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Exam Score<span class="text-danger">*</span><em> Highest Point Is 60</em></span></label>
                                                                                    <input type="number" name="exam_score" class="form-control" value="{{old('exam_score')}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subject"> Total <span class="text-danger">*</span><em> Total score is over 100</em></span></label>
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
                                        @empty
                                            {{-- <tr>
                                                <td class="font-size-sm"> <em  class="text-muted"> Class Result For {{$name}} Has Not Been Created </em></td>
                                                <td class="font-size-sm"> <em  class="text-muted"> Subjects Result For {{$name}} Has Not Been Created </em></td>
                                                <td class="font-size-sm"> <em  class="text-muted">Edit </em></td>
                                            </tr> --}}
                                            <h1 class="text-center">
                                                Subjects Results Has Not Been Created
                                            </h1>
                                        @endforelse
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

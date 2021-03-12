@extends('layouts.backend-teacher')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    View Student
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Student</a>
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

                    <!-- List Of Subject -->
                    <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Select The Subject You Would Like To See Students</h3>
                        </div>
                        <div class="block-content">
                            <table class="table table-borderless table-vcenter table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1; 
                                    @endphp
                                    @forelse($teacher as $data)
                                        <tr class="table-active">
                                            <th class="text-center" scope="row">{{$count}}</th>
                                            <td class="font-w600 font-size-sm">{{$data->subject_name}}</td>
                                            <td class="font-w600 font-size-sm">{{$data->class}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <div class="btn-group">
                                                        {{-- <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#edit{{ $data->id }}" title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger push" data-toggle="modal" data-target="#delete{{ $data->id }}" title="Delete">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button> --}}
                                                        <form action="{{ route('view-student-action') }}">
                                                            <input type="hidden" name="subject_name" value="{{ $data->subject_name }}">
                                                            <input type="hidden" name="teacher_name" value="{{ $data->teacher_name }}">
                                                            <input type="hidden" name="class" value="{{ $data->class }}">

                                                             <div class="form-group">
                                                                <button type="submit" class="btn btn-sm btn-block btn-secondary">
                                                                    <i class="fa fa-fw fa-plus mr-1"></i> View Students
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>   
                                        @php
                                            $count++;
                                        @endphp
                                    @empty
                                        <h1>You Are yet To Be Assigned To A Subject. Please Contact The Data_operator For More Information</h1>
                                    @endforelse                                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- END List Of Subject -->
                


            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

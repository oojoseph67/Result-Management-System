@extends('layouts.simple')

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

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">{{$name}} <small>Result</small></h3>
            </div>
            <div class="block-content">

                <!-- Full Table -->
                    <div class="block">
                        <h1 class="text-center">
                            <span class="font-w600 font-size-sm">
                                <button onclick="window.print()" class="btn btn-primary">
                                    <i class="fa fa-fw fa-plus mr-1"></i> Print
                                </button>
                            </span>
                            <br>
                            <span class="font-w600 font-size-sm">{{$name}}</span>
                            <br>
                            <img class="img-avatar img-avatar-thumb" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
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
                                Name : {{$name}}
                            </span>
                            <br>
                            <span class="font-w600 font-size-sm">
                                Class Average : {{$class_avg}}
                            </span>
                            <span class="font-w600 font-size-sm">
                                Total In Class : {{$total_in_class}}
                            </span>
                            <br>
                            <span class="font-w600 font-size-lg">
                                {{$name}} Average : {{$user_avg}}
                            </span>                           
                        </h1>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center" style="width: 100px;">
                                                <i class="far fa-user"></i>
                                            </th> --}}
                                            {{-- <th>Name</th> --}}
                                            <th style="width: 15%;">Subject</th>
                                            <th style="width: 15%;">Attendance</th>
                                            <th style="width: 15%;">First Test</th>
                                            <th style="width: 15%;">Second Test</th>
                                            <th style="width: 15%;">Third Test</th>
                                            <th style="width: 15%;">Quiz</th>
                                            <th style="width: 15%;">Exam</th>
                                            <th class="text-center" style="width: 100px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result as $data)
                                            <tr>
                                                {{-- <td class="text-center">
                                                    <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                                </td> --}}
                                                {{-- <td class="font-w600 font-size-sm">
                                                    <a href="">{{ $data->name }}</a>
                                                </td> --}}
                                                <td>
                                                    <span class="badge">{{ $data->subject_name }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->attendance_score }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->first_test }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->second_test }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->third_test }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->quiz }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->exam_score }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge">{{ $data->total }}</span>
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

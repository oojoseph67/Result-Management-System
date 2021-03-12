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
                    View <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Student</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Student</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">List of student for {{$class}} {{$subject_name}} </a>
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
                <h3 class="block-title">Block Title</h3>
            </div>
            <div class="block-content">
                <p class="font-size-sm text-muted">
                   This is a list of students in {{$class}} for {{$subject_name}}
                </p>

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
                            <h3 class="block-title">List Of Subject</h3>
                        </div>
                        <div class="block-content">
                            <table class="table table-borderless table-vcenter table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Techer Name</th>
                                        <th>Email</th>
                                        <th>Date Of Birth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1; 
                                    @endphp
                                    @forelse($students as $data)
                                        <tr class="table-active">
                                            <th class="text-center" scope="row">{{$count}}</th>
                                            <td class="font-w600 font-size-sm">
                                                <a href="{{ route('view-student-profile', ['name' => $data->name]) }}">{{$data->name}}</a>
                                            </td>
                                            <td class="font-w600 font-size-sm">{{$data->email}}</td>
                                            <td class="font-w600 font-size-sm">{{$data->dob}}</td>
                                        </tr>   
                                        @php
                                            $count++;
                                        @endphp
                                    @empty
                                        <h1> No Student In {{$class}} For {{$subject_name}} </h1>
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

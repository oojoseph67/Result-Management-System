@extends('layouts.backend-admin')

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
                    {{-- Main Title <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Subtitle</small> --}}
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Generate Result</a>
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
                <h3 class="block-title">Generate Result</h3>
            </div>
            <div class="block-content">
                {{-- <p class="font-size-sm text-muted">
                   Welcome Admin
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

                <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
                
                @if ($results_data->isEmpty())
                    <div class="row items-push">
                        <div class="col-lg-4">
                            <h4> Reset Calendar for current session {{Auth::user()->session}} </h4>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <form action="{{ route('reset-calendar') }}" method="POST">
                                <div class="form-group">
                                    <label for="teacher">Input Session<span class="text-danger">*</span></label>
                                    <input type="text" name="session" class="form-control" placeholder="1234/5678">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Default Term <span class="text-danger">*</span></label>
                                    <input type="text" name="term" disabled value="First Term" class="form-control">
                                </div>
                                
                                {{-- <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">
                                        <i class="fa fa-fw fa-plus mr-1"></i> Assign Teacher
                                    </button>
                                </div>                 --}}

                            

                                <button type="button" class="btn btn-sm btn-secondary push" data-toggle="modal" data-target="#reset" title="Reset">
                                    <i class="fa fa-fw fa-times"></i> Reset
                                </button>


                            
                                <!-- Generate Block Modal -->                                                
                                    <div class="modal" id="reset" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
                                        <div class="modal-dialog modal-sm-6" role="document">
                                            <div class="modal-content">
                                                <div class="block block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">Input Password To Reset The Calender For {{Auth::user()->session}}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                            @csrf 
                                                            <div class="form-group">
                                                                <label for="">Password</label>
                                                                <input type="password" name="password" class="form-control">
                                                                <div class="input-group-append" data-password="false">
                                                                    <div class="input-group-text">
                                                                        <span class="password-eye"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-secondary"> Reset</button>
                                                            </div>   
                                                    </div>
                                                    <div class="block-content block-content-full text-right border-top">
                                                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                                        {{-- <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- END Generate Block Modal -->
                            </form>
                        </div>
                    </div>
                @else
                    <h1> Before Reseting Calendar Generate Result</h1>
                @endif

            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

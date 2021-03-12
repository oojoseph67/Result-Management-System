@extends('layouts.backend-super-admin')

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
                    Manage Teacher
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{ route('manage-users') }}">Manage User</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Manage Teacher</a>
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
                <!-- Full Table -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">List Of Teacher</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-settings"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 100px;">
                                                <i class="far fa-user"></i>
                                            </th>
                                            <th>Name</th>
                                            <th style="width: 30%;">Email</th>
                                            <th style="width: 15%;">Access</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacher as $data)
                                            <tr>
                                                <td class="text-center">
                                                    <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                                </td>
                                                <td class="font-w600 font-size-sm">
                                                    <a href="be_pages_generic_profile.html">{{ $data->name }}</a>
                                                </td>
                                                <td class="font-size-sm"><em class="text-muted">{{ $data->email }}</em></td>
                                                <td>
                                                    <span class="badge badge-primary">Personal</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#edit{{ $data->id }}" title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger push" data-toggle="modal" data-target="#delete{{ $data->id }}" title="Delete">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Edit Block Modal -->                                                
                                                <div class="modal" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm-6" role="document">
                                                        <div class="modal-content">
                                                            <div class="block block-themed block-transparent mb-0">
                                                                <div class="block-header bg-primary-dark">
                                                                    <h3 class="block-title">Edit Teacher Profile</h3>
                                                                    <div class="block-options">
                                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-fw fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content font-size-sm">
                                                                    <form action="{{ route('edit-user') }}" method="POST">
                                                                        @csrf
                                                                        <div class="py-3">
                                                                            <input type="hidden" name="id" value="{{ $data->id }}">

                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control form-control-lg form-control-alt" name="name" value="{{ $data->name }}"">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="email" class="form-control form-control-lg form-control-alt" name="email" value="{{ $data->email }}">
                                                                            </div>
                                                                             <div class="form-group">
                                                                                <input type="date" class="form-control form-control-lg form-control-alt" name="dob" value="{{ $data->dob }}">
                                                                            </div>
                                                                            {{-- <h3 class="block-title">Password Update Is Optional</h3>
                                                                            <div class="form-group">
                                                                                <input type="password" class="form-control form-control-lg form-control-alt" name="password" >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="password" class="form-control form-control-lg form-control-alt" name="password_confirmation" >
                                                                            </div> --}}
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-md-6 col-xl-5">
                                                                                <button type="submit" class="btn btn-block btn-success">
                                                                                    <i class="fa fa-fw fa-plus mr-1"></i> Update Profile
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

                                            <!-- Delete Block Modal -->
                                                <div class="modal" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="block block-themed block-transparent mb-0">
                                                                <div class="block-header bg-primary-dark">
                                                                    <h3 class="block-title">Tobias Title</h3>
                                                                    <div class="block-options">
                                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-fw fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content font-size-sm">                                                                    
                                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                                    <p>
                                                                        Are You Sure You Want To Delete This Teacher <b>{{$data->name}}</b>
                                                                    </p>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" data-target="#password{{$data->id}}" data-toggle="modal" data-dismiss="modal" class="btn btn-primary">Contine</button>
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
                                                <div class="modal" id="password{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="block block-themed block-transparent mb-0">
                                                                <div class="block-header bg-primary-dark">
                                                                    <h3 class="block-title">Tobias Title</h3>
                                                                    <div class="block-options">
                                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-fw fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content font-size-sm">                                                                    
                                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                                    <p>
                                                                        Input Password to delete Teacher <b>{{$data->name}}</b>
                                                                    </p>
                                                                    <form action="{{ route('delete-user') }}" method="POST">
                                                                        @csrf

                                                                        <input type="hidden" name="role" value="{{$data->role}}">
                                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                                        <input type="hidden" name="name" id="{{$data->name}}">
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
                                                                            <button type="submit" class="btn btn-primary">Delete Teacher</button>
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
                    </div>
                    <!-- END Full Table -->
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

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
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Subject Management <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Create Subject</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Subject Management</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Create Subject</a>
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
                <h3 class="block-title">Create Subject</h3>
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


                <!-- Create Subject -->
                    <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
                    <form action="{{ route('create-action') }}" method="">
                        @csrf
                        <div class="row items-push">
                            <div class="col-lg-4">
                                {{-- <p class="font-size-sm text-muted">
                                    You can easily validate any kind of data you like either it is in a normal input, a textarea or a select box
                                </p> --}}
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="form-group">
                                    <label for="subject_name">Subject Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject_name" autocomplete="off" name="subject_name" placeholder="Input Subject Name" required>
                                </div>
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
                                        <i class="fa fa-fw fa-plus mr-1"></i> Create Subject
                                    </button>
                                </div>
                            </div>                    
                        </div>
                    </form>
                <!-- END Create Subject -->


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
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subject_data as $data)
                                    <tr class="table-active">
                                        <th class="text-center" scope="row">#</th>
                                        <td class="font-w600 font-size-sm">{{$data->subject_name}}</td>
                                        <td class="font-w600 font-size-sm">{{$data->class}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                               <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#edit{{ $data->id }}" title="Edit">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger push" data-toggle="modal" data-target="#delete{{ $data->id }}" title="Delete">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit Block Modal -->                                                
                                        <div class="modal" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
                                            <div class="modal-dialog modal-sm-6" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">Edit Subject</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                    <i class="fa fa-fw fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="block-content font-size-sm">
                                                            <form action="{{ route('update-subject') }}" method="POST">
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
                                                                Are You Sure You Want To Delete This Subject <b>{{$data->subject_name}}</b>
                                                            </p>
                                                            <form action="{{ route('delete-subject') }}">
                                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                                <input type="hidden" name="subject_name" value="{{$data->subject_name}}">
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-block btn-danger">
                                                                        <i class="fa fa-fw fa-times mr-1"></i> Delete Subject
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
                                   @empty
                                        <tr class="text-center"> NO DATA</tr>
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

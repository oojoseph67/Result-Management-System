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
                    {{-- Main Title <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Subtitle</small> --}}
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Profile</a>
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


                <!-- Profile Container -->
                    <main id="main-container">
                        <!-- Hero -->
                        <div class="bg-image" style="background-image: url('assets/media/photos/photo8@2x.jpg');">
                            <div class="bg-black-75">
                                <div class="content content-full text-center">
                                    <div class="my-3">
                                        <img class="img-avatar img-avatar-thumb" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                    </div>
                                    <h1 class="h2 text-white mb-0">Edit Account</h1>
                                    <h2 class="h4 font-w400 text-white-75">
                                    {{Auth::user()->name}}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <!-- END Hero -->

                        <!-- Page Content -->
                        <div class="content content-boxed">
                            <!-- User Profile -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Teacher Profile</h3>
                                </div>
                                <div class="block-content">
                                    <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row push">
                                            <div class="col-lg-4">
                                                <p class="font-size-sm text-muted">
                                                    Your account’s vital info. Your username will be publicly visible.
                                                </p>
                                                <b>
                                                     <p class="font-size-sm text-muted">
                                                        To change your date of birth please contact the Data Operator                                                   
                                                     </p>
                                                </b>
                                            </div>
                                            <div class="col-lg-8 col-xl-5">

                                                <input type="hidden" name="id" value="{{Auth::user()->id}}">

                                                <div class="form-group">
                                                    <label for="one-profile-edit-name">Name</label>
                                                    <input type="text" class="form-control" id="one-profile-edit-name" name="name" value="{{Auth::user()->name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="one-profile-edit-email">Email Address</label>
                                                    <input type="email" class="form-control" id="one-profile-edit-email" name="email" value="{{Auth::user()->email}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="one-profile-edit-dob">Date Of Birth</label>
                                                    <input type="email" class="form-control" id="one-profile-edit-dob" name="dob" value="{{Auth::user()->dob}}" disabled>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="one-profile-edit-dob">Class</label>
                                                    <input type="email" class="form-control" id="one-profile-edit-dob" name="dob" value="{{Auth::user()->current_class}}" disabled>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label>Your Profile Picture</label>
                                                    <div class="push">
                                                        <img class="img-avatar" src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                                    </div>
                                                    <div class="custom-file">
                                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                                        {{-- <input type="file" class="custom-file-input" name="passport" value="{{ Auth::user()->passport_path }}"> --}}
                                                        <input type="file" name="passport" id=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-alt-success">
                                                        Update Profile
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END User Profile -->

                             <!-- Change Password -->
                                <div class="block">
                                    <div class="block-header">
                                        <h3 class="block-title">Change Password</h3>
                                    </div>
                                    <div class="block-content">
                                        <form action="{{ route('change-password') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row push">
                                                <div class="col-lg-4">
                                                    <p class="font-size-sm text-muted">
                                                        Changing your sign in password is an easy way to keep your account secure.
                                                    </p>
                                                </div>
                                                <div class="col-lg-8 col-xl-5">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label for="one-profile-edit-password-new">New Password</label>
                                                            <input type="password" class="form-control" id="one-profile-edit-password-new" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label for="one-profile-edit-password-new-confirm">Confirm New Password</label>
                                                            <input type="password" class="form-control" id="one-profile-edit-password-new-confirm" name="password_confirmation">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-alt-success">
                                                            Update Password
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <!-- END Change Password -->
                        </div>
                        <!-- END Page Content -->
                    </main>
                <!-- END Profile Container -->


            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection

@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="row">
        <div class="col-xs-12">
            @include('flash::message')
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-warning card-outline">
                <form id="ChangePassword" action="{{url('/store_change_password')}}" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Password Reset Form</h3>

                        <div class="card-tools">
                            {{--<button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>--}}
                            {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            {{--@foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Current password:<span style="color: #ff0000">*</span></label>
                                    <input type="password" class="form-control" name="current_password" autocomplete="current-password"
                                           id="current_password" />
                                    <span style="color: red">@error('current_password'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New Password:<span style="color: #ff0000">*</span></label>
                                    <input type="password" class="form-control" name="new_password" autocomplete="current-password"
                                           id="new_password" />
                                    <span style="color: red">@error('new_password'){{$message}} @enderror</span>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm Password:<span style="color: #ff0000">*</span></label>
                                        <input type="password" class="form-control" name="new_confirm_password" autocomplete="current-password"
                                               id="new_confirm_password" />
                                        <span style="color: red">@error('new_confirm_password'){{$message}} @enderror</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div style="float: right;">
                            <div class="btn-group" >
                                <a href="{{url()->previous()}}">
                                    <button type="button" class="btn btn-default"> Close</button>
                                </a>

                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-info bg-gradient-success" data-toggle="tooltip" data-placement="bottom" title="Save Records">
                                    <i class="fa fa-save"></i> Update password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection


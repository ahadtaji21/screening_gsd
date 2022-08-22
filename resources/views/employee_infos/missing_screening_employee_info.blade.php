@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Screening Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Employee Screening</a></li>
                        <li class="breadcrumb-item active">Missing Employee Screening Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="SearchMissingEmp" action="javascript.void(0)">
                @csrf
                <input type="hidden" name="created_by" id="created_by" value="{{Auth::user()->id}}">
                <input type="hidden" name="user_region_id" id="user_region_id" value="{{Auth::user()->region_id}}">
                <input type="hidden" name="user_field_office_id" id="user_field_office_id" value="{{Auth::user()->field_office_id}}">
                {{--<input type="text" name="dashboard_screening_status" id="dashboard_screening_status" value="{{$screening_status}}">--}}

                <div class="card card-purple collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-search"></i> Search Criteria</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-info bg-gradient-fuchsia btn-sm"
                                    data-toggle="modal" data-target="#modal-default-help">
                                <i class="fa fa-wheelchair"></i> Help
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                                        <option value="">All</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Prefer not to say">Prefer not to say</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ref. No/ Name/ NIC/ Passport</label>
                                    <input type="text"  class="form-control"
                                           placeholder="Ref. No/ Name/ NIC/ Passport" name="nic" id="nic">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Created Date (from - to)</label>
                                    <div class="input-group date" id="datePicker" data-target-input="nearest">
                                        <input type="date" class="form-control" name="created_at_from" id="created_at_from"/>
                                        <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i>to</i></div>
                                        </div>
                                        <input type="date" class="form-control" name="created_at_to" id="created_at_to"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Screening Status</label>
                                    <select class="form-control select2" name="screening_status" id="screening_status" style="width: 100%;">
                                        <option value="">All</option>
                                        <option value="1">Pending</option>
                                        {{--<option value="2">In-progress</option>--}}
                                        <option value="2">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="display: block">
                        <div>
                            <div class="btn-group" >
                                <button type="button" class="btn btn-default" id="btnReset">
                                    <i class="fa fa-refresh"></i> Reset</button>

                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-info bg-gradient-primary" data-toggle="tooltip"
                                        data-placement="bottom" title="Search Records">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
            </form>
            <!-- /.card -->
            {{----      Modal      ----}}

            <div class="modal fade" id="modal-default-help">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <img src="dist/img/screening_status_flow.png" alt="Screening Status Flow"
                                     style="width: 90%; height: 90%; margin-left: 30px">
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- Table -->
            <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-th"></i> Missing Employee Screening Details</h3>
                    <div class="card-tools">
                        {{--<div class="btn-group">
                            <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i> Tools
                            </a>
                            <ul class="dropdown-menu pull-left" id="ScreeningGrid_tools">
                                <li>
                                    <a href="javascript:;" data-action="0" class="tool-action dropdown-item">
                                        <i class="fa fa-copy"></i> Copy</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="1" class="tool-action dropdown-item">
                                        <i class="fa fa-paperclip"></i> Excel</a>
                                </li>
                                <li class="dropdown-divider"></li>
                            </ul>
                        </div>--}}
                        {{--<a href="#" class="btn btn-group btn-outline-success" data-toggle="tooltip" title="Download">
                            <i class="fas fa-file-download"> Download Data</i>
                        </a>--}}


                        {{--<a href="/screening_add" class="btn btn-group btn-outline-warning" data-toggle="tooltip" title="Add">
                            <i class="fas fa-pen"> Add New Screening</i>
                        </a>--}}
                        <a href="{{ url('employee_info_add') }}" class="btn btn-group btn-primary" data-toggle="tooltip" title="Add">
                            <i class="fas fa-pen"> Add New Employee</i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="MissingEmpGrid" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th colspan="8"><i class="fas fa-user"></i> Employee Info</th>
                            <th colspan="2"><i class="fas fa-user-clock"></i> User Info</th>
                        </tr>
                        <tr>

                            <th>Name</th>
                            <th>Gender</th>

                            <th>NIC/ Passport</th>

                            <th>DOB</th>
                            <th>Email</th>
                            <th>Nationality</th>
                            <th>Ethnicity</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src={{asset("plugins/jquery/jquery.min.js")}}></script>

@include('js.common')
@include('js.setting.employee_info.Missing_employee_info')
<!-- /.content-wrapper -->
<script>
    /*$(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(function () {

        $('#reservationdate').datetimepicker({
            format: 'L'
        });

    });*/



</script>

@endsection


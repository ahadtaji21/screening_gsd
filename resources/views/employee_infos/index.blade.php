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
                        <li class="breadcrumb-item active">Employee Screening Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="SearchScreening" action="javascript.void(0)">
                @csrf
                <input type="hidden" name="region_clicked" id="region_clicked" value="{{$region_clicked}}">
                <input type="hidden" name="user_region_id" id="user_region_id" value="{{Auth::user()->region_id}}">
                <input type="hidden" name="user_field_office_id" id="user_field_office_id" value="{{Auth::user()->field_office_id}}">
                {{--<input type="text" name="dashboard_screening_status" id="dashboard_screening_status" value="{{$screening_status}}">--}}

                <div class="card card-info collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-search"></i> Search Criteria</h3>

                        <div class="card-tools">
                            {{--<div class="btn-group">
                                <button type="button" class="btn bg-gradient-fuchsia"><i class="fa fa-wheelchair"></i> Help </button>
                                <button type="button" class="btn bg-gradient-fuchsia dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-default-help" href="#">
                                        <span style="color: #0a001f">
                                            <i class="fa fa-wheelchair"></i> Work Flow
                                        </span>
                                    </a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-default-user-guide" href="#">
                                        <span style="color: #0a001f">
                                            <i class="fa fa-directions"></i> User Guide
                                        </span>
                                    </a>
                                </div>
                            </div>--}}

                            {{--<button type="button" class="btn btn-info bg-gradient-fuchsia btn-sm"
                                    data-toggle="modal" data-target="#modal-default-help">
                                <i class="fa fa-wheelchair"></i> Help
                            </button>--}}
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
                                    <label>Department</label>
                                    <select class="form-control select2" name="department_id" id="department_id" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Region</label>
                                    <select class="form-control select2" name="region_id" id="region_id" style="width: 100%;">


                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Field Office</label>
                                    <select class="form-control select2" name="field_office_id" id="field_office_id" style="width: 100%;">


                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <select class="form-control select2" name="designation_id" id="designation_id" style="width: 100%;">


                                    </select>
                                </div>
                            </div>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Staff Type</label>
                                    <select class="form-control select2" name="type_of_staff" id="type_of_staff" style="width: 100%;">
                                        {{--<option value="">All</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Consultant">Consultant</option>
                                        <option value="Short-term">Short-term</option>
                                        <option value="Intern">Intern</option>
                                        <option value="Volunteer">Volunteer</option>--}}

                                        <option value="" {{  ($type_of_staff == '') ? 'selected' : '' }}>All</option>
                                        <option value="Employee" {{  ($type_of_staff == 'Employee') ? 'selected' : '' }}>Employee</option>
                                        <option value="Part-time" {{  ($type_of_staff == 'Part-time') ? 'selected' : '' }}>Part-time</option>
                                        <option value="Consultant" {{  ($type_of_staff == 'Consultant') ? 'selected' : '' }}>Consultant</option>
                                        <option value="Short-term" {{  ($type_of_staff == 'Short-term') ? 'selected' : '' }}>Short-term</option>
                                        <option value="Intern" {{  ($type_of_staff == 'Intern') ? 'selected' : '' }}>Intern</option>
                                        <option value="Volunteer" {{  ($type_of_staff == 'Volunteer') ? 'selected' : '' }}>Volunteer</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Screening Result</label>
                                    <select class="form-control select2" name="screening_result" id="screening_result" style="width: 100%;">
                                        <option value="">All</option>
                                        <option value="NMF">NMF (No Match Found)</option>
                                        <option value="FMF">FMF (False Match Found)</option>
                                        <option value="PMF">PMF (Possible Match Found)</option>
                                        {{--<option value="PTMF">PTMF</option>
                                        <option value="MIR">MIR</option>--}}

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Screening Status</label>
                                    <select class="form-control select2" name="screening_status" id="screening_status" style="width: 100%;">
                                        {{--<option value="">All</option>--}}
                                        <option value="" {{  ($screening_status == '') ? 'selected' : '' }}>All</option>
                                        <option value="1" {{  ($screening_status == 1) ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{  ($screening_status == 2) ? 'selected' : '' }}>Completed</option>
                                        {{--<option value="1">Pending</option>--}}
                                        {{--<option value="2">In-progress</option>--}}
                                        {{--<option value="2">Completed</option>--}}
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
                                    <label class="control-label">Screening Date (from - to)</label>
                                    <div class="input-group date" id="datePicker" data-target-input="nearest">
                                        <input type="date" class="form-control" name="screening_date_from" id="screening_date_from"/>
                                        <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i>to</i></div>
                                        </div>
                                        <input type="date" class="form-control" name="screening_date_to" id="screening_date_to"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Contract Date (start - end)</label>
                                    <div class="input-group date" id="datePicker" data-target-input="nearest">
                                        <input type="date" class="form-control" name="contract_start_date" id="contract_start_date"/>
                                        <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i>to</i></div>
                                        </div>
                                        <input type="date" class="form-control" name="contract_end_date" id="contract_end_date"/>
                                    </div>
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
                                    <label>Created by</label>
                                    <select class="form-control select2" name="created_by" id="created_by" style="width: 100%;">

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

            {{----      Modal      ----}}

            <div class="modal fade" id="modal-default-user-guide">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <a href="dist/img/GSD - User guide.docx" alt="User Guide">
                                    <i class="fa fa-download"></i> Download User Guide
                                </a>
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
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-th"></i> Employee Screening Details</h3>
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
                    <table id="ScreeningGrid" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th colspan="3"><i class="fas fa-user"></i> Employee Info</th>
                            <th colspan="7"><i class="fas fa-file"></i> Screening Info</th>
                            <th colspan="2"><i class="fas fa-user-clock"></i> User Info</th>
                        </tr>
                        <tr>

                            <th>Name</th>
                            <th>Gender</th>

                            <th>NIC</th>
                            <th>Ref. No.</th>
                            {{--<th>NIC / Passport</th>
                            <th>DOB</th>
                            <th>Email</th>--}}
                            <th>Region - Country</th>

                            <th>Department</th>
                            <th>Job Title</th>
                            {{--<th>Emp Status</th>--}}
                            <th>Status</th>
                            <th>Result</th>
                            <th>Screen Dated</th>

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
@include('js.setting.employee_info.Employee_info')
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


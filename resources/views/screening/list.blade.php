@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Screening Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Screening</a></li>
                        <li class="breadcrumb-item active">Screening Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info collapsed-card">
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
                                <label>Department</label>
                                <select class="form-control select2" name="department_id" id="department_id" style="width: 100%;">
                                    <option selected="selected">All</option>
                                    <option value="1">ICT</option>
                                    <option value="2">HR</option>
                                    <option value="2">Admin</option>
                                    <option value="2">Project</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control select2" name="country" id="country" style="width: 100%;">
                                    <option selected="selected">All</option>
                                    <option value="1">Pakistan</option>
                                    <option value="2">Bangladesh</option>
                                    <option value="1">India</option>
                                    <option value="2">UK</option>
                                    <option value="1">Kenya</option>
                                    <option value="2">Egypt</option>
                                    <option value="2">Palestine</option>
                                    <option value="1">Switzerland</option>
                                    <option value="1">Turkey</option>
                                    <option value="2">South Africa</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control select2" name="gender_id" id="gender_id" style="width: 100%;">
                                    <option selected="selected">All</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Screening Result</label>
                                <select class="form-control select2" name="screening_result" id="screening_result" style="width: 100%;">
                                    <option selected="selected">All</option>
                                    <option value="1">NMF</option>
                                    <option value="2">FMF</option>
                                    <option value="1">PMF</option>
                                    <option value="2">PTMF</option>
                                    <option value="2">MIR</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Staff Type</label>
                                <select class="form-control select2" name="type_of_staff" id="type_of_staff" style="width: 100%;">
                                    <option selected="selected">All</option>
                                    <option value="1">Employee</option>
                                    <option value="2">Part-time</option>
                                    <option value="1">Consultant</option>
                                    <option value="2">Short Term</option>
                                    <option value="2">Intern</option>
                                    <option value="2">Volunteer</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ref. No/ Name/ NIC/ Passport/ Job Title</label>
                                <input type="text"  class="form-control"
                                       placeholder="Ref. No/ Name/ NIC/ Passport/ Job Title" name="nic" id="nic">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Screening Date</label>
                                <div class="input-group date" id="datePicker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datePicker"/>
                                    <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Start & Leaving Date</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Created Date</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- /.card-body -->
                <div class="card-footer" style="display: block">
                    <div>
                        <div class="btn-group" >
                            <button type="button" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>

                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info bg-gradient-secondary" data-toggle="tooltip" data-placement="bottom" title="Search Records">
                                <i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-th"></i> Screening Details</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-group brn-sm btn-outline-success" data-toggle="tooltip" title="Download">
                            <i class="fas fa-file-download"> Download Data</i>
                        </a>
                        <!-- <a href="/screening_add" class="btn btn-group btn-outline-warning" data-toggle="tooltip" title="Add">
                            <i class="fas fa-pen"> Add New Screening</i>
                        </a> -->
                        <a href="{{ url('employee_info_add') }}" class="btn btn-group btn-outline-warning" data-toggle="tooltip" title="Add">
                            <i class="fas fa-pen"> Add New Screening Employee</i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th colspan="10"><i class="fas fa-user"></i> Employee Info</th>
                            <th colspan="3"><i class="fas fa-user-clock"></i> User Info</th>
                        </tr>
                        <tr>
                            <th>Ref. No.</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Staff Type</th>
                            <th>Gender</th>
                            <th>Nationality</th>
                            <th>Start Date</th>
                            <th>Result</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->reference_no}}</td>
                            <td>{{ $employee->employee_name }}</td>
                            <td>{{ $employee->field_office_id }}</td>
                            <td>Employee</td>
                            <td>{{ $employee->gender }}</td>
                            <td>{{ $employee->nationality }}</td>
                            <td>{{ $employee->created_at }}</td>
                            <td></td>
                            <td class="project-state">
                                
                                <!-- <span class="badge badge-warning">Pending</span> -->
                            </td>
                            <td>{{ $employee->created_at }}</td>
                            <td>{{ $employee->created_by }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('screening_add_2',$employee->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Screening">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('screening_view',$employee->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="View & Edit">
                                        <i class="fas fa-pen-nib"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
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
<!-- /.content-wrapper -->
<script>
    $(function () {
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

    });



</script>

@endsection


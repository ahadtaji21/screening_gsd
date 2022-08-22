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
            <!-- SELECT2 EXAMPLE -->
            <!-- /.card -->

            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> Employee Info</h3>
                    <div class="card-tools">

                        <a href="{{ url('employee_info_edit',$employee->id) }}">
                            <button type="button" class="btn btn-info bg-gradient-secondary btn-sm"
                                    data-toggle="tooltip" data-placement="bottom" title="Edit Employee Records">
                                <i class="fa fa-edit"></i> Edit Form
                            </button>
                        </a>

                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-12">
                                <form id="ShowScreeningDetail">
                                    <input type="hidden" id="employee_info_id" name="employee_info_id"
                                           value="{{ $employee->id }}">

                                    <!-- /.card-header -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference No:</label>
                                                <span id="reference_no">{{$employee->reference_no}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Employee Name:</label>
                                                <span id="employee_name">{{$employee->employee_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Father Name: </label>
                                                <span id="father_name">{{$employee->father_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>DOB:</label>
                                                <span id="dob">{{$employee->dob}}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Birth Country: </label>
                                                <span id="country_of_birth_name">{{$employee->country_of_birth_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Residence (FO):</label>
                                                <span id="field_office_name">{{$employee->field_office_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email: </label>
                                                <span id="email">{{$employee->email}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Gender: </label>
                                                <span id="gender_id">{{$employee->gender_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Passport: </label>
                                                <span id="passport">{{$employee->passport}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NIC: </label>
                                                <span id="nic">{{$employee->nic}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nationality:</label>
                                                <span id="nationality_name">{{$employee->nationality_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Ethnicity: </label>
                                                <span id="ethnicity_name">{{$employee->ethnicity_name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address: </label>
                                                <span id="address">{{$employee->address}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <span id="created_by_name"><i>This employee record has been
                                                    created by <strong>{{$employee->created_employee_by_name}}</strong>
                                                    at <strong>{{$employee->created_employee_at}}</strong>{{$employee->updation_employee}}.
                                                </i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </form>
                            </div>
                        </div>

                    </section>
                </div>
                <!-- /.card-body -->
            </div>


            <!-- Table -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-paperclip"></i> Screeings</h3>
                    <div class="card-tools">
                        <a href="{{ url('screening_add_2',$employee->id) }}">
                            <button type="button" class="btn btn-info bg-gradient-primary btn-sm"
                                    data-toggle="tooltip" data-placement="bottom" title="Add Screening">
                                <i class="fa fa-plus"></i> Add Screening
                            </button>
                        </a>

                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-12" id="accordion">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                    <tr>
                                        <th>Ref. No.</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Staff Type</th>
                                        <th>NIC</th>
                                        <th>C.Start Date</th>
                                        <th>C.End Date</th>

                                        <th>Screen Date</th>
                                        <th>Result</th>
                                        <th>Created at</th>
                                        <th>Created by</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($screenings as $screening)
                                        <tr>
                                            <td>{{$employee->reference_no}}</td>
                                            <td>{{$employee->employee_name}}</td>
                                            <td>{{$employee->field_office_name}}</td>
                                            <td>{{$screening->type_of_staff}}</td>
                                            <td>{{$employee->nic}}</td>
                                            <td>{{$screening->contract_start_date}}</td>
                                            <td>{{$screening->contract_end_date}}</td>

                                            <td>{{$screening->screening_date}}</td>
                                            <td>{{$screening->screening_result}}</td>
                                            <td>{{$screening->created_at}}</td>
                                            <td>{{$screening->created_by}}</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ url('screening_edit_2/'.$employee->id.'/'.$screening->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Screening Record">
                                                        <i class="fas fa-pen-nib"></i>
                                                    </a>
                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ url('screening_view/'.$screening->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="View Screening Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                                <!-- <tr>
                                    <td>PK0134</td>
                                    <td>Ahad Ahmed Taji</td>
                                    <td>Pakistan</td>
                                    <td>Volunteer</td>
                                    <td>5440040243671</td>
                                    <td>2016-02-23</td>
                                    <td>2016-03-23</td>

                                    <td>UK-23987</td>
                                    <td>2016-02-03</td>
                                    <td>NMF</td>
                                    <td>2016-01-15</td>
                                    <td>Ilyas</td>
                                    <td class="text-right py-0 align-middle">

                                    </td>
                                </tr>
                                <tr>
                                    <td>PK2456</td>
                                    <td>Ahad Ahmed Taji</td>
                                    <td>Pakistan</td>
                                    <td>Intern</td>
                                    <td>5440040243671</td>
                                    <td>2017-05-01</td>
                                    <td>2018-01-31</td>

                                    <td>UK-54653</td>
                                    <td>2017-04-15</td>
                                    <td>FMF</td>
                                    <td>2017-04-01</td>
                                    <td>Asma</td>
                                </tr>
                                <tr>
                                    <td>PK3456</td>
                                    <td>Ahad Ahmed Taji</td>
                                    <td>Pakistan</td>
                                    <td>Part time</td>
                                    <td>5440040243671</td>
                                    <td>2019-02-01</td>
                                    <td>2019-12-31</td>

                                    <td>UK-90908</td>
                                    <td>2019-01-27</td>
                                    <td>NMF</td>
                                    <td>2019-01-13</td>
                                    <td>Adil</td>
                                </tr>
                                <tr>
                                    <td>PK7678</td>
                                    <td>Ahad Ahmed Taji</td>
                                    <td>Pakistan</td>
                                    <td>Employee</td>
                                    <td>5440040243671</td>
                                    <td>2021-08-23</td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>2021-08-15</td>
                                    <td>Ilyas</td>
                                </tr> -->
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </section>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
<script src={{asset("js/common.js")}}></script>


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
            "responsive": true
        });
    });*/


    (function($) {
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'success',
                title: 'Form has been saved but fill attachments below..'
            });


            /*$('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Form has been saved but fill attachments below..'
                })
            });*/
        });
    })(jQuery);





</script>

@endsection


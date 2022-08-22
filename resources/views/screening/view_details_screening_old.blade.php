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

            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">History</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel"
                             aria-labelledby="custom-tabs-two-home-tab">
                            <form>
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-th"></i> Details</h3>

                                    <div class="card-tools">
                                        {{--<button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>--}}
                                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>--}}
                                        <a href="/screening_edit">
                                            <button type="button" class="btn btn-info bg-gradient-secondary btn-sm"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit Records">
                                                <i class="fa fa-edit"></i> Edit Form
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-info bg-gradient-info btn-sm"
                                                data-toggle="modal" data-target="#modal-default">
                                            <i class="fa fa-arrow-circle-left"></i> In-progress
                                        </button>
                                        <button type="button" class="btn btn-info bg-gradient-success btn-sm"
                                                data-toggle="modal" data-target="#modal-default-completed">
                                            <i class="fa fa-arrow-circle-down"></i> Completed
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Reference No:</label>
                                            <span id="reference_no">PK0134</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Name:</label>
                                            <span id="reference_no">Ahad Ahmed Taji</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Father Name: </label>
                                            <span id="reference_no">Maqsood Ahmed Taji</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>DOB:</label>
                                            <span id="reference_no">1988-01-21</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Birth Country: </label>
                                            <span id="reference_no">Pakistan</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Residence:</label>
                                            <span id="reference_no">Pakistan</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <span id="reference_no">ahad.ahmed@irp.org.pk</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender: </label>
                                            <span id="reference_no">Male</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Staff Type:</label>
                                            <span class="badge badge-primary" id="reference_no">Employee</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Job Title: </label>
                                            <span class="badge badge-info" id="reference_no">Sr. Developer</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Dept.: </label>
                                            <span id="reference_no">ICT</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Manager: </label>
                                            <span id="reference_no">Businees Lead</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Passport: </label>
                                            <span id="reference_no">N/A</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>NIC: </label>
                                            <span id="reference_no">5440040243671</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nationality:</label>
                                            <span id="reference_no">Pakistani</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ethnicity: </label>
                                            <span id="reference_no">Pakistan</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contract Start Date: </label>
                                            <span id="reference_no">2021-08-23</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contract End Date: </label>
                                            <span id="reference_no">N/A</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>User: </label>
                                            <span id="reference_no">Adil Shahzad</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Created at </label>
                                            <span id="reference_no">2021-09-03</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status: </label>
                                            <span class="badge badge-danger" id="type">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Result: </label>
                                            <span class="badge badge-success" id="reference_no">N/A</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Screening Date: </label>
                                            <span id="reference_no">2021-09-03</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ref ID (Thompson Reuters): </label>
                                            <span id="reference_id">N/A</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>ID Expiry Date: </label>
                                            <span id="reference_no">N/A</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>On Behalf: </label>
                                            <span id="reference_no">N/A</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address: </label>
                                            <span id="reference_no">House 76, st 5, Shalley Valley , range road rawalpindi.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Comments: </label>
                                    <span id="reference_no">Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for its demise,
                                        but others ignore. Some people hate it and argue for its demise, but others ignore</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                             aria-labelledby="custom-tabs-two-profile-tab">
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

                                    <th>Ref ID<br><small>Thompson Reuters</small></th>
                                    <th>Screen Date</th>
                                    <th>Result</th>
                                    <th>Created at</th>
                                    <th>Created by</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
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
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->


            <!-- Table -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-paperclip"></i> Attachements</h3>
                    <div class="card-tools">

                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-8" id="accordion">
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Attach Passport/ NIC
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-xs-12" id="attachment">
                                                Passport.jpg
                                            </div>

                                            <div class="col-xs-12">
                                                <input type="file" id="file_attachment" name="file_attachment"
                                                                    class="btn btn-success" multiple>
                                                <button type="button" id="btnAttachment" class="btn btn-primary"><i
                                                            class="fa fa-paperclip"></i> Attach files
                                                </button>
                                                <br><br>
                                                <div class="input-group date" id="expiry_date" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input input-medium" data-target="#dob"
                                                           name="expiry_date" id="expiry_date" placeholder="Enter Expiry Date"/>
                                                    <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Resume
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-xs-12" id="attachment">
                                            </div>

                                            <div class="col-xs-12">
                                                <input type="file" id="file_attachment" name="file_attachment"
                                                       class="btn btn-success" multiple>
                                                <button type="button" id="btnAttachment" class="btn btn-primary"><i
                                                            class="fa fa-paperclip"></i> Attach files
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Qualification
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-xs-12" id="attachment">
                                            </div>

                                            <div class="col-xs-12">
                                                <input type="file" id="file_attachment" name="file_attachment"
                                                       class="btn btn-success" multiple>
                                                <button type="button" id="btnAttachment" class="btn btn-primary"><i
                                                            class="fa fa-paperclip"></i> Attach files
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Experience
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-xs-12" id="attachment">
                                            </div>

                                            <div class="col-xs-12">
                                                <input type="file" id="file_attachment" name="file_attachment"
                                                       class="btn btn-success" multiple>
                                                <button type="button" id="btnAttachment" class="btn btn-primary"><i
                                                            class="fa fa-paperclip"></i> Attach files
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Police Character Certificate
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-xs-12" id="attachment">
                                            </div>

                                            <div class="col-xs-12">
                                                <input type="file" id="file_attachment" name="file_attachment"
                                                       class="btn btn-success" multiple>
                                                <button type="button" id="btnAttachment" class="btn btn-primary"><i
                                                            class="fa fa-paperclip"></i> Attach files
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Other
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-xs-12" id="attachment">
                                            </div>

                                            <div class="col-xs-12">
                                                <input type="file" id="file_attachment" name="file_attachment"
                                                       class="btn btn-success" multiple>
                                                <button type="button" id="btnAttachment" class="btn btn-primary"><i
                                                            class="fa fa-paperclip"></i> Attach files
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Status Marking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <input type="text" readonly name="status" value="Pending" class="form-control">
                </div>
                <br>
                <div class="input-group date" id="status_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input input-medium" data-target="#dob"
                           name="status_date" id="status_date" placeholder="Enter Date"/>
                    <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Mark Status</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-default-completed">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Status Marking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <input type="text" readonly name="status" value="Pending" class="form-control">
                </div>
                <br>
                <div class="input-group date" id="status_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input input-medium" data-target="#dob"
                           name="status_date" id="status_date" placeholder="Enter Date"/>
                    <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <br>
                <div>
                    <select class="form-control select2" name="department_id" id="department_id" style="width: 100%;">
                        <option value="">Select Result</option>
                        <option value="1">NFM</option>
                        <option value="2">FMF</option>
                        <option value="2">PMF</option>
                        <option value="2">PTMF</option>
                        <option value="2">MIR</option>

                    </select>
                </div>
                <br>

                <div>
                    <input type="text" name="ref_id" class="form-control" placeholder="Enter Thompson Reuters Reference ID">
                </div>
                <br>
                <div class="input-group date" id="screening_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input input-medium" data-target="#dob"
                           name="screening_date" id="screening_date" placeholder="Screening Date"/>
                    <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Mark Status</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
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


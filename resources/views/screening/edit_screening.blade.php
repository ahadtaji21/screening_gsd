@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Screening</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Screening</a></li>
                        <li class="breadcrumb-item active">Edit Screening</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-warning card-outline">
                <form id="EditScreening" action="/screening_edit">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Edit Screening Form</h3>

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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reference No.</label>
                                    <input type="text" class="form-control" readonly name="reference_no" id="reference_no"
                                           value="PK0134" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee Full Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="employee_name" id="employee_name"
                                    value="Ahad Ahmed Taji"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Father Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="father_name" id="father_name"
                                    value="Maqsood Ahmed Taji"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Date of birth:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group date" id="dob" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#dob"
                                        name="dob" id="dob" value="9-Sep-2021"/>
                                        <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country of Birth:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="country_of_birth" id="country_of_birth" style="width: 100%;">
                                        <option selected>Pakistan</option>

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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country of Residence:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="country_of_residence" id="country_of_residence" style="width: 100%;">
                                        <option selected>Pakistan</option>
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address"
                                    value="House 76, st5, shalley valley, rawalpindi"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="email"
                                        value="ahad.ahmed@irp.org.pk"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="gender_id" id="gender_id" style="width: 100%;">
                                        <option selected="selected">Male</option>

                                        <option value="Female">Female</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff Type:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="type_of_staff" id="type_of_staff" style="width: 100%;">
                                        <option selected="selected">Employee</option>

                                        <option value="2">Part-time</option>
                                        <option value="1">Consultant</option>
                                        <option value="2">Short Term</option>
                                        <option value="2">Intern</option>
                                        <option value="2">Volunteer</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Title:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="designation" id="designation"
                                    value="Sr. Developer"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="department" id="department"
                                    value="ICT"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Line Manager Designation</label>
                                    <input type="text" class="form-control" name="line_manager_designation"
                                           id="line_manager_designation" value="Busniess Lead"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Contract Start Date:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group date" id="contract_start_date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" value="23-Aug-2021"
                                               data-target="#contract_start_date" name="contract_start_date" id="contract_start_date"/>
                                        <div class="input-group-append" data-target="#contract_start_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Contract End Date</label>
                                    <div class="input-group date" id="contract_end_date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               data-target="#contract_end_date" name="contract_end_date" id="contract_end_date"/>
                                        <div class="input-group-append" data-target="#contract_end_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passport</label>
                                    <input type="text" class="form-control" name="passport" id="passport" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIC:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="nic" id="nic" value="5440040243671"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="nationality" id="nationality" style="width: 100%;">
                                        <option selected>Pakistan</option>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ethnicity:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="ethnicity" id="ethnicity" style="width: 100%;">
                                        <option selected>Pakistan</option>
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea type="text" class="form-control" name="comments" id="comments" rows="3">
                                        Attach documents
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>On Behalf</label>
                                    <select class="form-control select2" name="ethnicity" id="ethnicity" style="width: 100%;">
                                        <option value="">Select User</option>
                                        <option value="1">Mustafa</option>
                                        <option value="2">Ilayas</option>
                                        <option value="1">Adil</option>
                                        <option value="2">Asma</option>


                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bs-stepper linear">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step" data-target="#logins-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger" aria-selected="true">
                                        <span class="bs-stepper-circle"></span>
                                        <span class="bs-stepper-label">Various information</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>


                        @php
                        $screening_questions = \Config::get('screening_questions');
                        @endphp

                        @foreach($screening_questions as $keyScreeningQuestions => $valScreeningQuestions)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        {{$keyScreeningQuestions}}
                                        :<span style="color: #ff0000">*</span>
                                    </label>
                                    <select class="form-control select2" name="family_size[{{$keyScreeningQuestions}}]" id="questions" style="width: 100%;">

                                        <option selected="selected" value="1">Yes</option>
                                        <option value="2">No</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{--<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Were references obtained in accordance with IRW’s Reference Protocol
                                        :<span style="color: #ff0000">*</span>
                                    </label>
                                    <select class="form-control select2" name="ethnicity" id="ethnicity" style="width: 100%;">
                                        <option value="">Select...</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>

                                    </select>
                                </div>
                            </div>
                        </div>--}}


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div style="float: right;">
                            <div class="btn-group" >
                                <button type="button" class="btn btn-default"> Close</button>

                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-info bg-gradient-success" data-toggle="tooltip" data-placement="bottom" title="Save Records">
                                    <i class="fa fa-save"></i> Save Form</button>
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
</script>

@endsection


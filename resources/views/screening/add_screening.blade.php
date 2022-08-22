@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Screening</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Screening</a></li>
                        <li class="breadcrumb-item active">Add Screening</li>
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
                <form id="AddScreening" action="/insert_screening">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Add Screening Form</h3>

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
                                           placeholder="System Auto Generate" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee Full Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="employee_name" id="employee_name"
                                    required autocomplete="off"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Father Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="father_name" id="father_name"
                                           autocomplete="off" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Date of birth:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input"
                                               name="dob" id="dob" data-target="#reservationdate"/>
                                        {{--<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country of Birth:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="country_of_birth"
                                            id="country_of_birth" required style="width: 100%;">


                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country of Residence (field office):<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="field_office_id"
                                            id="field_office_id" required style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="email" required
                                        autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control custom-select" name="gender_id" id="gender_id"
                                            required style="width: 100%;">
                                        <option selected="selected">All</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff Type:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="type_of_staff" id="type_of_staff"
                                            required style="width: 100%;">
                                        <option selected="selected">All</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Consultant">Consultant</option>
                                        <option value="Short Term">Short Term</option>
                                        <option value="Intern">Intern</option>
                                        <option value="Volunteer">Volunteer</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Title:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="designation_id" id="designation_id"
                                            required style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="department_id" id="department_id"
                                            required style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Line Manager Designation</label>
                                    <select class="form-control select2" name="line_manager_designation"
                                            id="line_manager_designation" required style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Contract Start Date:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group date" id="contract_start_date" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input"
                                               data-target="#contract_start_date" name="contract_start_date"
                                               required id="contract_start_date" autocomplete="off"/>
                                        {{--<div class="input-group-append" data-target="#contract_start_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Contract End Date</label>
                                    <div class="input-group date" id="contract_end_date" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input"
                                               data-target="#contract_end_date" name="contract_end_date"
                                               id="contract_end_date" autocomplete="off"/>
                                        {{--<div class="input-group-append" data-target="#contract_end_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passport</label>
                                    <input type="text" class="form-control" name="passport" id="passport"
                                           autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIC:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="nic" id="nic"
                                           minlength="13" maxlength="13" autocomplete="off"/>
                                    <span class="description" style="font-size: small; color: grey;">
                                        Enter Without Dashes "-"
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="nationality" id="nationality"
                                            required style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ethnicity:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="ethnicity" id="ethnicity" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea type="text" class="form-control" name="comments" id="comments" rows="3">

                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>On Behalf</label>
                                    <select class="form-control select2" name="on_behalf_user" id="on_behalf_user" style="width: 100%;">

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


                        <div class="row">
                            @foreach($screening_questions as $keyScreeningQuestions => $valScreeningQuestions)
                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <label>
                                                {{$keyScreeningQuestions}}
                                                :<span style="color: #ff0000">*</span>
                                            </label>
                                            <select class="form-control custom-select" name="questions[{{$keyScreeningQuestions}}]"
                                                    id="questions" required style="width: 100%;">
                                                <option value="">Select...</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

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
<script src={{asset("plugins/jquery/jquery.min.js")}}></script>
<script src={{asset("js/common.js")}}></script>
<script src={{asset("js/setting/screening/Add_screening.js")}}></script>


@endsection


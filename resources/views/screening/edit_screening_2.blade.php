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
                <form id="AddScreening" action="{{ url('screening_update',$screening->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="old_field_office_id" value="{{$screening->field_office_id}}">
                    <input type="hidden" name="user_region_id" id="user_region_id" value="{{Auth::user()->region_id}}">
                    <input type="hidden" name="user_field_office_id" id="user_field_office_id" value="{{Auth::user()->field_office_id}}">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee Info ID.</label>
                                    <input type="text" class="form-control" readonly name="employee_info_id" id="employee_info_id"
                                           value="{{$screening->employee_info_id ?? ''}}" placeholder="System Auto Generate" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Reference No.</label>
                                    <input type="text" class="form-control" readonly name="reference_no" id="reference_no"
                                           placeholder="System Auto Generate" value="{{ $screening->reference_no ?? ''}}"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Region:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('region_id') is-invalid @enderror"
                                            name="region_id" id="region_id" style="width: 100%;" required>
                                        <option value="">Select Region</option>
                                        @forelse($regions as $nationality)
                                            <option value="{{$nationality->id}}" {{ ($nationality->id == $screening->region_id) ? 'selected' : '' }}> {{$nationality->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('region_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country of Residence (FO):<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('field_office_id') is-invalid @enderror"
                                            name="field_office_id" id="field_office_id" style="width: 100%;" required>
                                        <option value="">Select Office</option>
                                        @forelse($field_offices as $office)
                                            <option value="{{$office->id}}" {{ ($office->id == $screening->field_office_id) ? 'selected' : '' }}> {{$office->acronym}} - {{$office->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('field_office_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Staff Type:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('type_of_staff') is-invalid @enderror" name="type_of_staff" id="type_of_staff" style="width: 100%;" 
                                    required>
                                        <option value="Employee" {{ ($screening->type_of_staff == "Employee") ? 'selected' : '' }}>Employee</option>
                                        <option value="Part-time" {{ ($screening->type_of_staff == "Part-time") ? 'selected' : '' }}>Part-time</option>
                                        <option value="Consultant" {{ ($screening->type_of_staff == "Consultant") ? 'selected' : '' }}>Consultant</option>
                                        <option value="Short Term" {{ ($screening->type_of_staff == "Short Term") ? 'selected' : '' }}>Short Term</option>
                                        <option value="Intern" {{ ($screening->type_of_staff == "Intern") ? 'selected' : '' }}>Intern</option>
                                        <option value="Volunteer" {{ ($screening->type_of_staff == "Volunteer") ? 'selected' : '' }}>Volunteer</option>
                                    </select>
                                    @error('type_of_staff')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Job Title:<span style="color: #ff0000">*</span></label>
                                    <!-- <input type="text" class="form-control" name="designation" id="designation" /> -->
                                    <select class="form-control select2 @error('designation') is-invalid @enderror" name="designation" id="designation" style="width: 100%;"
                                    required>
                                      <option value="">Select Job Title</option>
                                        @forelse($designations as $designation)
                                        <option value="{{$designation->id}}" {{ ($designation->id == $screening->designation_id) ? 'selected' : '' }}> {{$designation->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>  
                                    @error('designation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Department:<span style="color: #ff0000">*</span></label>
                                    <!-- <input type="text" class="form-control" name="department" id="department" /> -->
                                    <select class="form-control select2 @error('department') is-invalid @enderror" name="department" id="department" style="width: 100%;"
                                    required>
                                        <option value="">Select Department</option>
                                        @forelse($departments as $department)
                                        <option value="{{$department->id}}" {{ ($department->id == $screening->department_id) ? 'selected' : '' }}> {{$department->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('department')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Line Manager Job Title</label>
                                    <!-- <input type="text" class="form-control" name="line_manager_designation"
                                           id="line_manager_designation" /> -->
                                    <select class="form-control select2 @error('line_manager_designation') is-invalid @enderror" name="line_manager_designation" id="line_manager_designation" style="width: 100%;" required>
                                        <option value="">Select Line Manager's Job Title</option>
                                        @forelse($designations as $desig_line_manager)
                                            <option value="{{$desig_line_manager->id}}" {{ ($desig_line_manager->id == $screening->line_manager_designation) ? 'selected' : '' }}> {{$desig_line_manager->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('line_manager_designation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>On Behalf</label>
                                    <select class="form-control select2 @error('on_behalf_user') is-invalid @enderror" name="on_behalf_user" id="on_behalf_user" style="width: 100%;">
                                        <option value="">Select User</option>
                                        @forelse($users as $on_behalf_user)
                                        <option value="{{$on_behalf_user->id}}" {{ ($on_behalf_user->id == $screening->on_behalf_user) ? 'selected' : '' }}> {{$on_behalf_user->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('on_behalf_user')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Contract Start Date:</label>
                                    <div class="input-group date" id="contract_start_date" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input @error('contract_start_date') is-invalid @enderror"
                                               data-target="#contract_start_date" name="contract_start_date" id="contract_start_date"
                                               value="{{ $screening->contract_start_date ?? '' }}" min="1919-04-10" max="5020-04-20"/>
                                        <!-- <div class="input-group-append" data-target="#contract_start_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> -->
                                        @error('contract_start_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Contract End Date</label>
                                    <div class="input-group date  @error('contract_end_date') is-invalid @enderror" id="contract_end_date" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input"
                                               data-target="#contract_end_date" name="contract_end_date" id="contract_end_date"
                                               value="{{ $screening->contract_end_date ?? '' }}" min="1919-04-10" max="5020-04-20">
                                        <!-- <div class="input-group-append" data-target="#contract_end_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> -->
                                        @error('contract_end_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if($screening->screening_status == 2 && $screening->employee_status == 0)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employee Status:<span style="color: #ff0000">*</span></label>
                                        <select class="form-control select2 @error('employee_status') is-invalid @enderror" name="employee_status" id="employee_status" style="width: 100%;"
                                                required>
                                            <option value="0" {{ ($screening->employee_status == "0") ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ ($screening->employee_status == "1") ? 'selected' : '' }}>Active</option>

                                        </select>
                                        @error('type_of_staff')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comments<span style="color: #ff0000">*</span></label>
                                    <textarea type="text" class="form-control" name="comments" id="comments" rows="3" required>{{ $screening->comments ?? '' }}</textarea>
                                </div>
                            </div>
                            
                        </div>

                        {{--<div class="bs-stepper linear">
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
                        </div>--}}


                        {{--@php
                        $screening_questions = \Config::get('screening_questions');
                        $screening_questions_db = json_decode($screening->questions,true);
                        @endphp--}}
           
                        {{--<div class="row">
                            @foreach($screening_questions as $keyScreeningQuestions => $valScreeningQuestions)
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="form-group">
                                                <label>
                                                    {{$keyScreeningQuestions}}
                                                    :<span style="color: #ff0000">*</span>
                                                </label>
                                                <select class="form-control select" name="family_size[{{$keyScreeningQuestions}}]" id="questions" style="width: 100%;" required>
                                                    <option value="">Select...</option>
                                                    <option value="1" {{ ($screening_questions_db[$keyScreeningQuestions] == "1") ? "selected" : "" }}>Yes</option>
                                                    <option value="2" {{ ($screening_questions_db[$keyScreeningQuestions] == "2") ? "selected" : "" }}>No</option>
                                                    <!-- <option value="1">Yes</option>
                                                    <option value="2">No</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>--}}
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
<script>
    $(function () {

        var user_region_id = $('#user_region_id').val();
        var user_field_office_id = $('#user_field_office_id').val();

        if (user_region_id == 0)
        {
            $("#field_office_id").prop("disabled", true);
        }
        else
        {
            $("#field_office_id").prop("disabled", false);
        }


        $("#region_id").change(function()
        {
            //$("#field_office_id").removeAttribute('Disabled');
            var id=$(this).val();
            console.log(id);
            var dataString = 'id='+ id;
            console.log(dataString);
            $.ajax
            ({
                type: "GET",
                url: "{{url('/fillFieldOfficeByRegionDropDown')}}",
                data: dataString,
                cache: false,
                success: function(response)
                {
                    $("#field_office_id").prop("disabled", false);
                    $("#field_office_id").empty();
                    $("#field_office_id").append($('<option/>').attr("value", "").text("Select Field Office"));
                    console.log(response.data);
                    $.each(response.data, function (i, option) {
                        $("#field_office_id").append($('<option/>').attr("value", option.id).text(option.name +' - ' + option.acronym));
                    });
                }
            });

        });



        $.validator.setDefaults({
            submitHandler: function () {
                alert( "Form successful submitted!" );
            }
        });
        $('#AddScreening').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

@endsection


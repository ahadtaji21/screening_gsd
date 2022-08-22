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
                        <li class="breadcrumb-item"><a href="{{ url('employee_list') }}">Employee Screening</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('employee_view',$employee->id) }}">
                                View Employee and Screening Details</a></li>
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

                <form id="AddScreening" action="{{ url('screening_insert',$employee->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_region_id" id="user_region_id" value="{{Auth::user()->region_id}}">
                    <input type="hidden" name="user_field_office_id" id="user_field_office_id" value="{{Auth::user()->field_office_id}}">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee Info ID.</label>
                                    <input type="text" class="form-control" readonly name="employee_info_id" id="employee_info_id"
                                           value="{{$employee->id}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Reference No.</label>
                                    <input type="text" class="form-control" readonly name="reference_no" id="reference_no"
                                           placeholder="System Auto Generate" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Region:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('region_id') is-invalid @enderror" name="region_id" id="region_id" style="width: 100%;" required>

                                        {{--@forelse($regions as $nationality)
                                            <option value="{{$nationality->id}}"> {{$nationality->name}} </option>
                                        @empty
                                        @endforelse--}}
                                    </select>
                                    @error('region_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country of Residence (Field Office):<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('field_office_id') is-invalid @enderror" name="field_office_id" id="field_office_id" style="width: 100%;" required>
                                        <option value="">Select Office</option>
                                        {{--@forelse($field_offices as $office)
                                            <option value="{{$office->id}}"> {{$office->name}} - {{$office->acronym}} </option>
                                        @empty
                                        @endforelse--}}
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
                                        <option value="">Select Staff Type</option>
                                        <option value="Employee" {{ (old('type_of_staff') == "Employee") ? 'selected' : '' }}>Employee</option>
                                        <option value="Part-time" {{ (old('type_of_staff') == "Part-time") ? 'selected' : '' }}>Part-time</option>
                                        <option value="Consultant" {{ (old('type_of_staff') == "Consultant") ? 'selected' : '' }}>Consultant</option>
                                        <option value="Short Term" {{ (old('type_of_staff') == "Short Term") ? 'selected' : '' }}>Short Term</option>
                                        <option value="Intern" {{ (old('type_of_staff') == "Intern") ? 'selected' : '' }}>Intern</option>
                                        <option value="Volunteer" {{ (old('type_of_staff') == "Volunteer") ? 'selected' : '' }}>Volunteer</option>
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
                                        <option value="{{$designation->id}}" {{ (old('designation') == $designation->id) ? 'selected' : '' }}> {{$designation->name}} </option>
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
                                        <option value="{{$department->id}}" {{ (old('department') == $department->id) ? 'selected' : '' }}> {{$department->name}} </option>
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
                                    <label>Line Manager Job Title<span style="color: #ff0000">*</span></label></label>
                                    <!-- <input type="text" class="form-control" name="line_manager_designation"
                                           id="line_manager_designation" /> -->
                                    <select class="form-control select2 @error('line_manager_designation') is-invalid @enderror" name="line_manager_designation" id="line_manager_designation" style="width: 100%;" required>
                                        <option value="">Select Line Manager's Job Title</option>
                                        @forelse($designations as $desig_line_manager)
                                            <option value="{{$desig_line_manager->id}}" {{ (old('line_manager_designation') == $desig_line_manager->id) ? 'selected' : '' }}> {{$desig_line_manager->name}} </option>
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
                                        <option value="{{$on_behalf_user->id}}" {{ (old('on_behalf_user') == $on_behalf_user->id) ? 'selected' : '' }}> {{$on_behalf_user->name}} </option>
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
                                               min="1919-04-10" max="5020-04-20"/>
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
                                               min="1919-04-10" max="5020-04-20"/>
                                        <!-- <div class="input-group-append" data-target="#contract_end_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> -->
                                        @error('contract_end_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Attach Passport/ NIC<span style="color: #ff0000">*</span></label>
                                    <input type="file" id="file_attachment_nic" name="file_attachment_nic"
                                           class=" form-control btn btn-info @error('file_attachment_nic') is-invalid @enderror" required>
                                    @error('file_attachment_nic')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="checkbox" style="margin-top: 36px">
                                    <label>
                                        <input type="checkbox" name="valid_for_life_time" id="valid_for_life_time" value="Yes"> 
                                            NIC/Passport Valid for Life Time
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date of NIC/Passport</label>
                                    <div class="input-group date" id="expiry_date" data-target-input="nearest">
                                        <input type="date" class="form-control" value="{{ old('expiry_date') }}"
                                               data-target="#expiry_date" name="expiry_date"
                                               id="expiry_date" autocomplete="off" min="1919-04-10" max="5020-04-20"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Attach Police Character Certificate</label>
                                    <input type="file" id="file_attachment_police" name="file_attachment_police"
                                           class="form-control btn btn-secondary @error('file_attachment_police') is-invalid @enderror">
                                    @error('file_attachment_police')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comments<span style="color: #ff0000">*</span></label>
                                    <textarea type="text" class="form-control" name="comments" id="comments" rows="3"
                                              required>{{old('comments')}}</textarea>
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
                                            <select class="form-control select" name="family_size[{{$keyScreeningQuestions}}]" id="questions" style="width: 100%;"
                                            required>
                                                <option value="">Select...</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
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
                                <button type="submit" id="btnSubmit" class="btn btn-info bg-gradient-success" data-toggle="tooltip" data-placement="bottom" title="Save Records">
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
@include('js.common')
<script>
    $(function () {

        var user_region_id = $('#user_region_id').val();
        var user_field_office_id = $('#user_field_office_id').val();
        //var user_field_office_id = $.parseJSON(user_field_office_id);
        //alert(user_field_office_id);


        FillRegionsDropDown();

        function FillRegionsDropDown() {
            var region_id = $('#region_id');
            if (user_region_id == 0)
            {
                Helper_FillRegionsDropDown(region_id, "", "All");
            }
            else
            {
                Helper_FillRegionsByUserRegionDropDown(user_region_id, region_id, "", "Select Region");
            }


        }

        $("#region_id").change(function(){
            var id_val = $(this).val();
            FillFieldOfficesByRegionDropDown(id_val);

        });



        function FillFieldOfficesByRegionDropDown(region_id) {
            var field_office_id = $('#field_office_id');
            if (user_field_office_id != '')
            {
                Helper_FillFieldOfficesByUserFieldOfficeDropDown(user_field_office_id,field_office_id, "", "All");
            }
            else
            {
                Helper_FillFieldOfficesByRegionDropDown(region_id,field_office_id, "", "All");
            }

        }


        var OldValue = '{{ old('region_id') }}';
        if(OldValue !== '') {
            $('#region_id').val(OldValue );
            FillFieldOfficesByRegionDropDown(OldValue);
        }

        var OldValue = '{{ old('field_office_id') }}';
        if(OldValue !== '') {
            $('#field_office_id').val(OldValue );
        }


        // disbale submit button for 2 seconds in order to stop multiple submission while click submit button twice or more
        $('form').submit(function(){
            $(this).find(':submit').attr( 'disabled','disabled' );
            //the rest of your code
            setTimeout(() => {
                $(this).find(':submit').attr( 'disabled',false );
            }, 2000)
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

    $("#AddScreening #valid_for_life_time").on('click', function(){
            if($(this).is(':checked')){
                $('#AddScreening #expiry_date').attr('disabled', true);
            } else {
                $('#AddScreening #expiry_date').attr('disabled', false);
            }
    });


</script>

@endsection


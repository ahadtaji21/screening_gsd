@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Employee </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('employee_list') }}">Employee Screening Details</a></li>
                        <li class="breadcrumb-item active">Edit Employee</li>
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
                <form id="AddScreening" action="{{ url('employee_info_update',$employee->id) }}" method="post">
                    @csrf

                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Edit Employee Form</h3>

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
                            {{--<div class="col-md-4">
                                <div class="form-group">
                                    <label>Reference No.</label>
                                    <input type="text" class="form-control" readonly name="reference_no" id="reference_no"
                                        placeholder="System Auto Generate" value="{{ $employee->reference_no ?? ''}}"/>
                                </div>
                            </div>--}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee First Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('employee_name') is-invalid @enderror" name="employee_name" id="employee_name" 
                                    value="{{ $employee->employee_name ?? '' }}" required/>
                                    @error('employee_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee SUrname:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('employee_surname') is-invalid @enderror" name="employee_surname" id="employee_surname"
                                           value="{{ $employee->employee_surname ?? '' }}" required/>
                                    @error('employee_surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Father First Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" id="father_name" 
                                    value="{{ $employee->father_name ?? '' }}" required/>
                                    @error('father_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Father Surname:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('father_surname') is-invalid @enderror" name="father_surname" id="father_surname"
                                           value="{{ $employee->father_surname ?? '' }}" required/>
                                    @error('father_surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Date of birth:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group date" id="dob" data-target-input="nearest">
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror datetimepicker-input" data-target="#dob"
                                               name="dob" id="dob" value="{{ $employee->dob ?? '' }}" required min="1919-04-10" max="5020-04-20"/>
                                        <!-- <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div> -->
                                        @error('dob')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country of Birth:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('country_of_birth') is-invalid @enderror"
                                            name="country_of_birth" id="country_of_birth" style="width: 100%;" required>
                                        <option value="">Select Birth Country</option>
                                        @forelse($countries as $nationality)
                                            <option value="{{$nationality->id}}" {{ ($nationality->id == $employee->nationality) ? 'selected' : '' }}> {{$nationality->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('country_of_birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" 
                                    value="{{ $employee->address ?? '' }}" required/>
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                               value="{{ $employee->email ?? '' }}" required/>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gender:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('gender') is-invalid @enderror"
                                            name="gender" id="gender" style="width: 100%;" required>
                                        <option value="">All</option>
                                        <option value="Male"   {{ ($employee->gender == "Male") ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ ($employee->gender == "Female") ? 'selected' : '' }}>Female</option>
                                        <option value="Prefer not to say" {{ ($employee->gender == "Prefer not to say") ? 'selected' : '' }}>Prefer not to say</option>
                                    </select>
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Passport</label>
                                    <input type="text" class="form-control" name="passport" id="passport" value="{{ $employee->passport ?? '' }}"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>National Identification Card (NIC):<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('nic') is-invalid @enderror" name="nic" id="nic" 
                                    value="{{ $employee->nic ?? '' }}" required/>
                                    @error('nic')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nationality:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('nationality') is-invalid @enderror" name="nationality" id="nationality" style="width: 100%;" required>
                                        <option value="">Select Nationality</option>
                                        @forelse($countries as $nationality)
                                            <option value="{{$nationality->id}}" {{ ($nationality->id == $employee->nationality) ? 'selected' : '' }}> {{$nationality->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('nationality')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ethnicity:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('ethnicity') is-invalid @enderror" name="ethnicity" id="ethnicity"
                                           value="{{ $employee->ethnicity ?? '' }}" required/>
                                    @error('ethnicity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{--<div class="col-md-4">
                                <div class="form-group">
                                    <label>Ethnicity:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('ethnicity') is-invalid @enderror" name="ethnicity" id="ethnicity" style="width: 100%;" required>
                                        <option value="">Select Ethnicity</option>
                                        @forelse($countries as $ethnicity)
                                            <option value="{{$ethnicity->id}}" {{ ($ethnicity->id == $employee->ethnicity) ? 'selected' : '' }}> {{$ethnicity->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('ethnicity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>--}}
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
                                    <i class="fa fa-save"></i> Update Form</button>
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

        /*var user_region_id = $('#user_region_id').val();
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

        });*/



        /*$.validator.setDefaults({
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
                    email: "Please enter a vaild email address"
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
        });*/
    });
</script>

@endsection


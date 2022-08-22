@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('user_list') }}">User</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                <form id="AddUser" name="AddUser" action="{{url('/store_user')}}" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Add User Form</h3>

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required />
                                    <span style="color: red">@error('name'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="gender" id="gender" required style="width: 100%;">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ (old('gender') == "Male") ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ (old('gender') == "Female") ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <span style="color: red">@error('gender'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email:<span style="color: #ff0000">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                                    </div>
                                    <span style="color: red">@error('email'){{$message}} @enderror</span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password:<span style="color: #ff0000">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" required/>
                                    <span style="color: red">@error('password'){{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control select2" name="department_id" id="department_id" required style="width: 100%;">
                                        <option value="">Select Departments</option>
                                        @foreach($departments as $u)
                                            {{--<option value ="{{ $u->id }}">{{ $u->name }}</option>--}}
                                            <option value="{{$u->id}}" {{ (old('department_id') == $u->id) ? 'selected' : '' }}> {{$u->name}} </option>
                                        @endforeach

                                    </select>
                                    <span style="color: red">@error('department_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <select class="form-control select2" name="designation_id" id="designation_id" required style="width: 100%;">
                                        <option value="">Select Job Title</option>
                                        @foreach($designations as $u)
                                            {{--<option value ="{{ $u->id }}">{{ $u->name }}</option>--}}
                                            <option value="{{$u->id}}" {{ (old('designation_id') == $u->id) ? 'selected' : '' }}> {{$u->name}} </option>
                                        @endforeach

                                    </select>
                                    <span style="color: red">@error('designation_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Region</label>
                                    <select class="form-control select2" name="region_id" id="region_id" required style="width: 100%;">
                                        <option value="">Select Region</option>
                                        @foreach($regions as $u)
                                            {{--<option value ="{{ $u->id }}">{{ $u->name }}</option>--}}
                                            <option value="{{$u->id}}" {{ (old('region_id') == $u->id) ? 'selected' : '' }}> {{$u->name}} </option>
                                        @endforeach

                                    </select>
                                    <span style="color: red">@error('region_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Field Office:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="field_office_id[]" id="field_office_id"
                                            multiple style="width: 100%;">
                                        <option value="">Select Field Office</option>
                                        {{--@foreach($field_offices as $u)
                                            <option value ="{{ $u->id }}">{{ $u->name }} - {{$u->acronym}}</option>
                                        @endforeach--}}
                                    </select>
                                    <span style="color: red">@error('field_office_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Role:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="user_role_id" id="user_role_id" required style="width: 100%;">
                                        <option value="">Select Role</option>
                                        <option value="4" {{ (old('user_role_id') == "4") ? 'selected' : '' }}>SuperAdmin</option>
                                        <option value="1" {{ (old('user_role_id') == "1") ? 'selected' : '' }}>Administrator</option>
                                        <option value="2" {{ (old('user_role_id') == "2") ? 'selected' : '' }}>Operator</option>
                                        <option value="3" {{ (old('user_role_id') == "3") ? 'selected' : '' }}>Viewer</option>
                                    </select>
                                    <span style="color: red">@error('user_role_id'){{$message}} @enderror</span>
                                </div>
                            </div>                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="status" id="status" required style="width: 100%;">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ (old('status') == "1") ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ (old('status') == "2") ? 'selected' : '' }}>Unlock</option>
                                        <option value="3" {{ (old('status') == "3") ? 'selected' : '' }}>Locked</option>
                                    </select>
                                    <span style="color: red">@error('status'){{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Receive Email on Screening insertion:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="screening_add_email" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    <span style="color: red">@error('screening_add_email'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Receive Email on Screening Status:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="screening_status_email" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    <span style="color: red">@error('screening_status_email'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Receive Email on Screening Comment:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="screening_comment_email" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    <span style="color: red">@error('screening_comment_email'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Receive Email on Marking Leaver:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="employee_leaver_email" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    <span style="color: red">@error('employee_leaver_email'){{$message}} @enderror</span>
                                </div>
                            </div>
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
                                <button type="submit" class="btn btn-info bg-gradient-success" data-toggle="tooltip"
                                        data-placement="bottom" title="Save Records">
                                    <i class="fa fa-save"></i> Save User</button>
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
<!-- jquery-validation -->
<script src={{asset("plugins/jquery-validation/jquery.validate.min.js")}}></script>
<script src={{asset("plugins/jquery-validation/additional-methods.min.js")}}></script>
{{--<script src='{{asset("js/common.js")}}'></script>--}}
<script>
    $(function () {

        var form1 = $('#AddUser');

9
        $("#region_id").change(function()
        {
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
                    $("#field_office_id").empty();

                    console.log(response.data);
                    $.each(response.data, function (i, option) {
                        $("#field_office_id").append($('<option/>').attr("value", option.id).text(option.name +' - ' + option.acronym));
                    });
                }
            });

        });




        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });



        /*var form1 = $('#AddUser');
        var field_office_id = $('#field_office_id', form1);


        FillFieldOfficesDropDown();


        //---------- Field Offices -------------//
        function FillFieldOfficesDropDown() {
            Helper_FillFieldOfficesDropDown(field_office_id, "", "All");

        }*/



        $('#AddUser').validate({
            rules: {
                name: {
                    required: true,
                    name: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                department_id: {
                    required: true
                },
                designation_id: {
                    required: true
                },
                field_office_id: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Please enter a name address",
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                terms: "Please accept our terms",
                department_id: "Please select department",
                designation_id: "Please select designation",
                field_office_id: "Please select field office"
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
            },
            submitHandler: function (form) {
                //form.submit();
                alert('submit');
            }
        });
        /*$.validator.setDefaults({
            submitHandler: function (form) {
                //form.submit();
                alert( "Form successful submitted!" );
            }
        });*/

    });

    $(function () {








        /*$.validator.setDefaults({
            submitHandler: function (form) {
                alert( "Form successful submitted!" );
            }
        });
        $('form#AddUser').validate({
            rules: {
                name: {
                    required: true,
                    name: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                department_id: {
                    required: true
                },
                designation_id: {
                    required: true
                },
                field_office_id: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Please enter a name address",
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                terms: "Please accept our terms",
                department_id: "Please select department",
                designation_id: "Please select designation",
                field_office_id: "Please select field office"
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


@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('user_list') }}">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                <form id="AddUser" name="AddUser" action="{{ url('/update_user/') }}/{{$user->id}}" method="post">
                    @csrf
                    <input type="hidden" name="user_region_id" id="user_region_id" value="{{Auth::user()->region_id}}">
                    <input type="hidden" name="user_field_office_id" id="user_field_office_id" value="{{Auth::user()->field_office_id}}">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Update User Form</h3>

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
                                    <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $user->name }}"/>
                                    <span style="color: red">@error('name'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                                        <option value="Male" {{  ($user->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{  ($user->gender == 'Female') ? 'selected' : '' }}>Female</option>
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
                                        <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $user->email }}">
                                    </div>
                                    <span style="color: red">@error('email'){{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control select2" name="department_id" id="department_id" style="width: 100%;">
                                        @foreach($departments as $d)
                                            <option value="{{ $d->id }}" {{ $d->id == $user->department_id ? 'selected' : '' }}>{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red">@error('department_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <select class="form-control select2" name="designation_id" id="designation_id" style="width: 100%;">
                                        @foreach($designations as $dd)
                                            <option value="{{ $dd->id }}" {{ $dd->id == $user->designation_id ? 'selected' : '' }}>{{ $dd->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red">@error('designation_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Region:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="region_id" id="region_id" style="width: 100%;">
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ $region->id == $user->region_id ? 'selected' : '' }}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <span style="color: red">@error('region_id'){{$message}} @enderror</span>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Field Office:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="field_office_id[]" id="field_office_id" multiple
                                            style="width: 100%;">
                                        @foreach($field_office_id as $office)
                                            <option value="{{ $office->id }}" {{ $office->id == in_array($office->id, $user->office_id) ? 'selected' : '' }}>{{ $office->acronym }} - {{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <span style="color: red">@error('field_office_id'){{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Role:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="user_role_id" id="user_role_id" style="width: 100%;">
                                        <option value="4" {{  ($user->user_role_id == 4) ? 'selected' : '' }}>SuperAdmin</option>
                                        <option value="1" {{  ($user->user_role_id == 1) ? 'selected' : '' }}>Administrator</option>
                                        <option value="2" {{  ($user->user_role_id == 2) ? 'selected' : '' }}>Operator</option>
                                        <option value="3" {{  ($user->user_role_id == 3) ? 'selected' : '' }}>Viewer</option>
                                    </select>
                                    <span style="color: red">@error('user_role_id'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2" name="status" id="status" style="width: 100%;">
                                        <option value="1" {{  ($user->status == 1) ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{  ($user->status == 2) ? 'selected' : '' }}>Unlock</option>
                                        <option value="3" {{  ($user->status == 3) ? 'selected' : '' }}>Locked</option>
                                    </select>
                                    <span style="color: red">@error('status'){{$message}} @enderror</span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Receive Email on Screening insertion:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="screening_add_email" data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $user->screening_add_email == 'on' ? 'checked' : '' }}>
                                    <span style="color: red">@error('screening_add_email'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Receive Email on Screening Status:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="screening_status_email" data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $user->screening_status_email == 'on' ? 'checked' : '' }}>
                                    <span style="color: red">@error('screening_status_email'){{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label>Receive Email on Screening Comment:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="screening_comment_email" data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $user->screening_comment_email == 'on' ? 'checked' : 'unchecked' }}>
                                    <span style="color: red">@error('screening_comment_email'){{$message}} @enderror</span>
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Receive Email on Marking Leaver:<span style="color: #ff0000">*</span></label>
                                    <input type="checkbox" name="employee_leaver_email" data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $user->employee_leaver_email == 'on' ? 'checked' : 'unchecked' }}>
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

<script>
    $(function () {

        /*var user_region_id = $('#user_region_id').val();
        var user_field_office_id = $('#user_field_office_id').val();

        var field_office_id = $('#field_office_id');
        if (user_field_office_id != '')
        {
            //alert(user_field_office_id);
            //Helper_FillFieldOfficesByUserFieldOfficeDropDown(user_field_office_id,field_office_id, "", "All");

            //field_office_id.append($('<option/>').attr("value", "").text("All"));
            var data = {
                "user_field_office_id": user_field_office_id
            };
            $.ajax({
                url: "{{url('/fillUserFieldOfficeDropDown')}}",
                type: 'get',
                dataType: 'json',
                data: data,
                success: function(response){

                    if (response.data !== null) {

                        $.each(response.data, function (i, option) {
                            field_office_id.append($('<option/>').attr("value", option.id).text(option.acronym+' - '+option.name));
                        });
                    }
                }
            });
        }*/


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



    });


</script>

@endsection


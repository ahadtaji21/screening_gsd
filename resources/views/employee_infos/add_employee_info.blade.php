@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('employee_list') }}">Employee Screening Details</a></li>
                        <li class="breadcrumb-item active">Add Employee</li>
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
                <form id="AddScreening" action="{{ url('employee_info_insert') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_region_id" id="user_region_id" value="{{Auth::user()->region_id}}">
                    <input type="hidden" name="user_field_office_id" id="user_field_office_id" value="{{Auth::user()->field_office_id}}">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Add Employee Form</h3>

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
                                    <label>Employee First Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('employee_name') is-invalid @enderror"
                                           name="employee_name" id="employee_name" value="{{ old('employee_name') }}" required/>
                                    @error('employee_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee Surname:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('employee_surname') is-invalid @enderror"
                                           name="employee_surname" id="employee_surname" value="{{ old('employee_surname') }}" required/>
                                    @error('employee_surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Father First Name:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                           name="father_name" id="father_name" value="{{ old('father_name') }}" required/>
                                    @error('father_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Father Surname:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('father_surname') is-invalid @enderror"
                                           name="father_surname" id="father_surname" value="{{ old('father_surname') }}" required/>
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
                                               name="dob" id="dob" value="{{old('dob')}}" required min="1919-04-10" max="5020-04-20"/>
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
                                    <select class="form-control select2 @error('country_of_birth') is-invalid @enderror" name="country_of_birth" id="country_of_birth" style="width: 100%;" required>
                                        <option value="">Select Birth Country</option>
                                        @forelse($countries as $nationality)
                                            <option value="{{$nationality->id}}" {{ (old('country_of_birth') == $nationality->id) ? 'selected' : '' }}> {{$nationality->name}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('country_of_birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{--<div class="col-md-4">
                                <div class="form-group">
                                    <label>Country of Residence (Field Office):<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('field_office_id') is-invalid @enderror" name="field_office_id" id="field_office_id" style="width: 100%;" required>
                                        <option value="">Select Office</option>
                                        --}}{{--@forelse($field_offices as $office)
                                            <option value="{{$office->id}}"> {{$office->name}} - {{$office->acronym}} </option>
                                        @empty
                                        @endforelse--}}{{--
                                    </select>
                                    @error('field_office_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address:<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                           name="address" id="address" value="{{ old('address') }}" required/>
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
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" id="email" value="{{ old('email') }}" required/>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gender:<span style="color: #ff0000">*</span></label>
                                    <select class="form-control select2 @error('gender') is-invalid @enderror" name="gender" id="gender" style="width: 100%;" required>
                                        <option selected="selected">Select Gender</option>
                                        <option value="Male" {{ (old('gender') == "Male") ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ (old('gender') == "Female") ? 'selected' : '' }}>Female</option>
                                        <option value="Prefer not to say" {{ (old('gender') == "Prefer not to say") ? 'selected' : '' }}>Prefer not to say</option>
                                    </select>
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Passport</label>
                                    <input type="text" class="form-control" name="passport" id="passport" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>National Identification Card (NIC):<span style="color: #ff0000">*</span></label>
                                    <input type="text" class="form-control @error('nic') is-invalid @enderror" name="nic" id="nic"
                                           value="{{ old('nic') }}" required/>
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
                                            <option value="{{$nationality->id}}" {{ (old('nationality') == $nationality->id) ? 'selected' : '' }}> {{$nationality->name}} </option>
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
                                           value="{{ old('ethnicity') }}" required/>
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
                                            <option value="{{$ethnicity->id}}"> {{$ethnicity->name}} </option>
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

        // ----------- old function -----------------
        /*$("#region_id").change(function()
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
                    $("#field_office_id").append($('<option/>').attr("value", "").text("Select Field Office"));
                    console.log(response.data);
                    $.each(response.data, function (i, option) {
                        $("#field_office_id").append($('<option/>').attr("value", option.id).text(option.name +' - ' + option.acronym));
                    });
                }
            });

        });*/


        var OldValue = '{{ old('region_id') }}';
        if(OldValue !== '') {
            $('#region_id').val(OldValue );
            FillFieldOfficesByRegionDropDown(OldValue);
        }

        var OldValue = '{{ old('field_office_id') }}';
        if(OldValue !== '') {
            $('#field_office_id').val(OldValue );
        }

    });
</script>

@endsection


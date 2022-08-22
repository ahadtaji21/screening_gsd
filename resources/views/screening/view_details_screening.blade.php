@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Screening Details {{$screening->Employee_info->employee_name}} {{$screening->Employee_info->employee_surname ?? ''}} ({{$screening->reference_no}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('employee_list') }}">Employee Screening</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('employee_view',$screening->employee_info_id) }}">View Employee and Screening Details</a></li>
                        <li class="breadcrumb-item active">View Screening details</li>
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
                        {{--<li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">History</a>
                        </li>--}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel"
                             aria-labelledby="custom-tabs-two-home-tab">
                            <form id="ShowScreeningDetail">
                                <input type="hidden" id="screening_detail_id" name="screening_detail_id"
                                       value="{{ $screening->id }}">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user"></i> Employee Details</h3>

                                    <div class="card-tools">
                                        {{--<button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>--}}
                                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>--}}
                                        {{--<a href="'/screening_edit/'.{{ $screening->id }}">
                                            <button type="button" class="btn btn-info bg-gradient-secondary btn-sm"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit Records" style="margin-top: -35px">
                                                <i class="fa fa-edit"></i> Edit Form
                                            </button>
                                        </a>--}}
                                        @if($screening->screening_status == '1')
                                            <a href="{{ url('screening_edit/'.$screening->employee_info_id.'/'.$screening->id) }}">
                                                <button type="button" class="btn btn-info bg-gradient-secondary btn-sm"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit Records" style="margin-top: -35px">
                                                    <i class="fa fa-edit"></i> Edit Screening Form
                                                </button>
                                            </a>
                                            {{--<button type="button" class="btn btn-info bg-gradient-info btn-sm"
                                                    data-toggle="modal" data-target="#modal-default-inprogress" style="margin-top: -35px">
                                                <i class="fa fa-arrow-circle-left"></i> In-progress
                                            </button>--}}
                                            @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                <button type="button" class="btn btn-info bg-gradient-success btn-sm"
                                                        data-toggle="modal" data-target="#modal-default-completed" style="margin-top: -35px">
                                                    <i class="fa fa-arrow-circle-down"></i> Completed
                                                </button>
                                            @endif

                                        @elseif($screening->screening_status == '2')
                                            <button type="button" class="btn btn-info bg-gradient-cyan " style="margin-top: -35px">
                                                <i class="fa fa-arrow-circle-down"></i> Screening done and result is {{$screening->screening_result}}
                                            </button>
                                        @endif

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="row">
                                    {{--<div class="col-md-3">
                                        <div class="form-group">
                                            <label>Reference No:</label>
                                            <span id="reference_no">{{$screening->Employee_info->reference_no}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Name:</label>
                                            <span id="employee_name">{{$screening->Employee_info->employee_name}}</span>
                                        </div>
                                    </div>--}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee First Name:</label>
                                            <span id="employee_name">{{$screening->Employee_info->employee_name}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Surname:</label>
                                            <span id="employee_surname">{{$screening->Employee_info->employee_surname ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Father First Name: </label>
                                            <span id="father_name">{{$screening->Employee_info->father_name ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Father Surname: </label>
                                            <span id="father_surname">{{$screening->Employee_info->father_surname ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>DOB:</label>
                                            <span id="dob">{{$screening->Employee_info->dob}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <span id="email">{{$screening->Employee_info->email ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender: </label>
                                            <span id="gender_id">{{$screening->Employee_info->gender}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Birth Country: </label>
                                            <span id="country_of_birth_name">{{$screening->Employee_info->countries->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>NIC: </label>
                                            <span id="nic">{{$screening->Employee_info->nic ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Passport: </label>
                                            <span id="passport">{{$screening->Employee_info->passport ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nationality:</label>
                                            <span id="nationality_name">{{$screening->Employee_info->nationalityId->name}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ethnicity: </label>
                                            <span id="ethnicity_name">{{$screening->Employee_info->ethnicity ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address: </label>
                                            <span id="address">{{$screening->Employee_info->address ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span id="created_by_name"><i>This employee record has been
                                                created by <strong>{{$screening->Employee_info->createdById->name ?? ''}}</strong>
                                             at <strong>{{$screening->Employee_info->created_at ?? ''}}</strong>
                                                    @if($screening->Employee_info->updated_by)
                                                        , and recently updated by <strong>{{$screening->Employee_info->updatedById->name ?? ''}}</strong> at <strong>{{$screening->Employee_info->updated_at ?? ''}}</strong>.
                                                    @endif
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                </div>



                                <h5><i class="fas fa-th"></i> Screening</h5>
                                <div class="dropdown-divider"> </div>
                                {{---------------------------------------------------------------------------}}


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Region: </label>
                                            <span id="region">{{$screening->regionId->name ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Residence (FO):</label>
                                            <span id="field_office_name">{{$screening->field_office->name ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Staff Type:</label>
                                            <span id="type_of_staff">{{$screening->type_of_staff}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Job Title: </label>
                                            <span id="designation">{{$screening->designationsId->name}}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Dept.: </label>
                                            <span id="department">{{$screening->departmentsId->name}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Manager: </label>
                                            <span id="line_manager_designation">{{$screening->lineManagerDesignationsId->name}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contract Start Date: </label>
                                            <span id="contract_start_date">{{$screening->contract_start_date}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contract End Date: </label>
                                            <span id="contract_end_date">{{$screening->contract_end_date}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>ID Expiry Date: </label>
                                            @if(count($screening->ScreeningDocumentDetail) > 0)
                                                <span id="expiry_date">{{$screening->ScreeningDocumentDetail[0]->expiry_date}}</span>
                                            @else
                                                <span id="expiry_date">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>On Behalf: </label>
                                            <span id="on_behalf_user_name">{{$screening->onBehalfUserId->name ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Emp Status: </label>
                                            <span class="badge badge-warning" id="employee_status">{{$employee_status_name ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status: </label>
                                            <span class="badge badge-success" id="screening_status">{{$screening_status_name ?? ''}}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Result: </label>
                                            <span class="badge badge-info" id="screening_result">{{$screening->screening_result ?? ''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Screening Date: </label>
                                            <span id="screening_date">{{$screening->screening_date ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Comments: </label>
                                            <span id="comments">{{$screening->comments}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span id="created_by_name"><i>This screening record has been
                                                created by <strong>{{$screening->scCreatedById->name ?? '' }}</strong>
                                             at <strong>{{$screening->created_at ?? '' }}</strong>
                                                    @if($screening->updated_by)
                                                        , and recently updated by <strong>{{$screening->scupdatedById->name ?? '' }}</strong> at <strong>{{$screening->updated_at ?? '' }}</strong>.
                                                    @endif
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Table -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-paperclip"></i> Attachments</h3>
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
                                    <div class="col-12" id="accordion">
                                        <form id="Form_Attach_NIC" method="post" action="javascript:void(0)"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Attach Passport/ NIC
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseOne" class="collapse show file_attachment_nic" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-xs-12" id="show_attachment_nic">
                                                            @if(count($file_nic) > 0)
                                                                @foreach ($file_nic as $nic)
                                                                    <div class="row col-md-12">
                                                                        <ul>
                                                                            <li>
                                                                                @php
                                                                                $img_extension = explode('.',$nic->file_name);
                                                                                $pic_arr = ['jpg','jpeg','png','gif','JPG','JPEG','PNG'];
                                                                                @endphp
                                                                                @if(in_array($img_extension[1],$pic_arr))
                                                                                    <img class="brand-image img-circle elevation-3" style="width: 7%; border: solid #b3d7ff"
                                                                                         src={{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}>
                                                                                @else
                                                                                    @if($img_extension[1] == 'docx')
                                                                                        <i class="fas fa-file-word text-primary"></i>
                                                                                    @elseif($img_extension[1] == 'pdf')
                                                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'ppt')
                                                                                        <i class="fas fa-file-powertpoint text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'xlsx' || $img_extension[1] == 'xlx')
                                                                                        <i class="fas fa-file-excel text-success"></i>
                                                                                    @elseif($img_extension[1] == 'zip')
                                                                                        <i class="fas fa-file-archive text-muted"></i>
                                                                                    @else
                                                                                        <i class="fas fa-file text-primary"></i>
                                                                                    @endif
                                                                                @endif
                                                                                &nbsp;&nbsp;
                                                                                <a href="{{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}" target="_blank">
                                                                                    {{$nic->attachment}} &nbsp;&nbsp;- Created by {{$nic->created_by}} at {{$nic->created_at}}
                                                                                </a>
                                                                                @if($nic->allow_edit == true  && $screening->screening_status == 1)
                                                                                    &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                @else
                                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                                                        &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <input type="file" id="file_attachment_nic" name="file_attachment_nic"
                                                                   class="btn btn-success" multiple>
                                                            <button type="button" id="btnAttachmentNIC" class="btn btn-primary"><i
                                                                        class="fa fa-paperclip"></i> Attach files
                                                            </button>
                                                            <br><br>
                                                            <div class="form-group">
                                                                <label class="control-label">Expiry Date</label>
                                                                <div class="input-group date" id="expiry_date" data-target-input="nearest">
                                                                    <input type="date" class="form-control" value="{{$nic->expiry_date ?? ''}}"
                                                                           data-target="#expiry_date" name="expiry_date"
                                                                           id="expiry_date" autocomplete="off" min="1919-04-10" max="5020-04-20"/>

                                                                    @if(count($screening->ScreeningDocumentDetail) > 0)
                                                                        @if($nic->valid_for_life_time == 'Yes')
                                                                            <div class="checkbox" style="margin-top: 6px">&nbsp;&nbsp;
                                                                                <label>
                                                                                    <input type="checkbox" name="valid_for_life_time" id="valid_for_life_time" 
                                                                                    value="Yes" checked> 
                                                                                        NIC/Passport Valid for Life Time
                                                                                </label>
                                                                            </div>
                                                                        @else
                                                                            <div class="checkbox" style="margin-top: 6px">&nbsp;&nbsp;
                                                                                <label>
                                                                                    <input type="checkbox" name="valid_for_life_time" id="valid_for_life_time" 
                                                                                    value="{{$nic->valid_for_life_time ?? ''}}"> 
                                                                                        NIC/Passport Valid for Life Time
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <div class="checkbox" style="margin-top: 6px">&nbsp;&nbsp;
                                                                            <label>
                                                                                <input type="checkbox" name="valid_for_life_time" id="valid_for_life_time" 
                                                                                value="{{$nic->valid_for_life_time ?? ''}}"> 
                                                                                    NIC/Passport Valid for Life Time
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form> {{--Form End -- Passport/NIC--}}
                                        <form id="Form_Attach_Resume" method="post" action="javascript:void(0)"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card card-secondary card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Resume
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseTwo" class="collapse file_attachment_resume" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-xs-12" id="show_attachment_resume">
                                                            @if(count($file_resume) > 0)
                                                                @foreach ($file_resume as $nic)
                                                                    <div class="row col-md-12">
                                                                        <ul>
                                                                            <li>
                                                                                @php
                                                                                $img_extension = explode('.',$nic->file_name);
                                                                                $pic_arr = ['jpg','jpeg','png','gif','JPG','JPEG','PNG'];
                                                                                @endphp
                                                                                @if(in_array($img_extension[1],$pic_arr))
                                                                                    <img class="brand-image img-circle elevation-3" style="width: 7%; border: solid #b3d7ff"
                                                                                         src={{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}>
                                                                                @else
                                                                                    @if($img_extension[1] == 'docx')
                                                                                        <i class="fas fa-file-word text-primary"></i>
                                                                                    @elseif($img_extension[1] == 'pdf')
                                                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'ppt')
                                                                                        <i class="fas fa-file-powertpoint text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'xlsx' || $img_extension[1] == 'xlx')
                                                                                        <i class="fas fa-file-excel text-success"></i>
                                                                                    @elseif($img_extension[1] == 'zip')
                                                                                        <i class="fas fa-file-archive text-muted"></i>
                                                                                    @else
                                                                                        <i class="fas fa-file text-primary"></i>
                                                                                    @endif
                                                                                @endif
                                                                                &nbsp;&nbsp;
                                                                                <a href="{{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}" target="_blank">
                                                                                    {{$nic->attachment}} &nbsp;&nbsp;- Created by {{$nic->created_by}} at {{$nic->created_at}}
                                                                                </a>
                                                                                @if($nic->allow_edit == true  && $screening->screening_status == 1)
                                                                                    &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                @else
                                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                                                        &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <input type="file" id="file_attachment_resume" name="file_attachment_resume"
                                                                   class="btn btn-success" multiple>
                                                            <button type="button" id="btnAttachmentResume" class="btn btn-primary"><i
                                                                        class="fa fa-paperclip"></i> Attach files
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>{{--Form End -- Resume --}}
                                        <form id="Form_Attach_Qualification" method="post" action="javascript:void(0)"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card card-fuchsia card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Qualification
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseThree" class="collapse file_attachment_qualification" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-xs-12" id="show_attachment_qualification">
                                                            @if(count($file_qualification) > 0)
                                                                @foreach ($file_qualification as $nic)
                                                                    <div class="row col-md-12">
                                                                        <ul>
                                                                            <li>
                                                                                @php
                                                                                $img_extension = explode('.',$nic->file_name);
                                                                                $pic_arr = ['jpg','jpeg','png','gif','JPG','JPEG','PNG'];
                                                                                @endphp
                                                                                @if(in_array($img_extension[1],$pic_arr))
                                                                                    <img class="brand-image img-circle elevation-3" style="width: 7%; border: solid #b3d7ff"
                                                                                         src={{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}>
                                                                                @else
                                                                                    @if($img_extension[1] == 'docx')
                                                                                        <i class="fas fa-file-word text-primary"></i>
                                                                                    @elseif($img_extension[1] == 'pdf')
                                                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'ppt')
                                                                                        <i class="fas fa-file-powertpoint text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'xlsx' || $img_extension[1] == 'xlx')
                                                                                        <i class="fas fa-file-excel text-success"></i>
                                                                                    @elseif($img_extension[1] == 'zip')
                                                                                        <i class="fas fa-file-archive text-muted"></i>
                                                                                    @else
                                                                                        <i class="fas fa-file text-primary"></i>
                                                                                    @endif
                                                                                @endif
                                                                                &nbsp;&nbsp;
                                                                                <a href="{{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}" target="_blank">
                                                                                    {{$nic->attachment}} &nbsp;&nbsp;- Created by {{$nic->created_by}} at {{$nic->created_at}}
                                                                                </a>
                                                                                @if($nic->allow_edit == true  && $screening->screening_status == 1)
                                                                                    &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                @else
                                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                                                        &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <input type="file" id="file_attachment_qualification" name="file_attachment_qualification"
                                                                   class="btn btn-success" multiple>
                                                            <button type="button" id="btnAttachmentQualification" class="btn btn-primary"><i
                                                                        class="fa fa-paperclip"></i> Attach files
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>{{--Form End -- Qualification --}}
                                        <form id="Form_Attach_Experience" method="post" action="javascript:void(0)"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card card-warning card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Experience
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseFour" class="collapse file_attachment_experience" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-xs-12" id="show_attachment_experiecne">
                                                            @if(count($file_experience) > 0)
                                                                @foreach ($file_experience as $nic)
                                                                    <div class="row col-md-12">
                                                                        <ul>
                                                                            <li>
                                                                                @php
                                                                                $img_extension = explode('.',$nic->file_name);
                                                                                $pic_arr = ['jpg','jpeg','png','gif','JPG','JPEG','PNG'];
                                                                                @endphp
                                                                                @if(in_array($img_extension[1],$pic_arr))
                                                                                    <img class="brand-image img-circle elevation-3" style="width: 7%; border: solid #b3d7ff"
                                                                                         src={{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}>
                                                                                @else
                                                                                    @if($img_extension[1] == 'docx')
                                                                                        <i class="fas fa-file-word text-primary"></i>
                                                                                    @elseif($img_extension[1] == 'pdf')
                                                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'ppt')
                                                                                        <i class="fas fa-file-powertpoint text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'xlsx' || $img_extension[1] == 'xlx')
                                                                                        <i class="fas fa-file-excel text-success"></i>
                                                                                    @elseif($img_extension[1] == 'zip')
                                                                                        <i class="fas fa-file-archive text-muted"></i>
                                                                                    @else
                                                                                        <i class="fas fa-file text-primary"></i>
                                                                                    @endif
                                                                                @endif
                                                                                &nbsp;&nbsp;
                                                                                <a href="{{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}" target="_blank">
                                                                                    {{$nic->attachment}} &nbsp;&nbsp;- Created by {{$nic->created_by}} at {{$nic->created_at}}
                                                                                </a>
                                                                                @if($nic->allow_edit == true  && $screening->screening_status == 1)
                                                                                    &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                @else
                                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                                                        &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <input type="file" id="file_attachment_experience" name="file_attachment_experience"
                                                                   class="btn btn-success" multiple>
                                                            <button type="button" id="btnAttachmentExperience" class="btn btn-primary"><i
                                                                        class="fa fa-paperclip"></i> Attach files
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>{{--Form End -- Experience --}}
                                        <form id="Form_Attach_Police" method="post" action="javascript:void(0)"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card card-success card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Police Character Certificate
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseFive" class="collapse file_attachment_police" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-xs-12" id="show_attachment_police">
                                                            @if(count($file_police) > 0)
                                                                @foreach ($file_police as $nic)
                                                                    <div class="row col-md-12">
                                                                        <ul>
                                                                            <li>
                                                                                @php
                                                                                $img_extension = explode('.',$nic->file_name);
                                                                                $pic_arr = ['jpg','jpeg','png','gif','JPG','JPEG','PNG'];
                                                                                @endphp
                                                                                @if(in_array($img_extension[1],$pic_arr))
                                                                                    <img class="brand-image img-circle elevation-3" style="width: 7%; border: solid #b3d7ff"
                                                                                         src={{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}>
                                                                                @else
                                                                                    @if($img_extension[1] == 'docx')
                                                                                        <i class="fas fa-file-word text-primary"></i>
                                                                                    @elseif($img_extension[1] == 'pdf')
                                                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'ppt')
                                                                                        <i class="fas fa-file-powertpoint text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'xlsx' || $img_extension[1] == 'xlx')
                                                                                        <i class="fas fa-file-excel text-success"></i>
                                                                                    @elseif($img_extension[1] == 'zip')
                                                                                        <i class="fas fa-file-archive text-muted"></i>
                                                                                    @else
                                                                                        <i class="fas fa-file text-primary"></i>
                                                                                    @endif
                                                                                @endif
                                                                                &nbsp;&nbsp;
                                                                                <a href="{{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}" target="_blank">
                                                                                    {{$nic->attachment}} &nbsp;&nbsp;- Created by {{$nic->created_by}} at {{$nic->created_at}}
                                                                                </a>
                                                                                @if($nic->allow_edit == true  && $screening->screening_status == 1)
                                                                                    &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                @else
                                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                                                        &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <input type="file" id="file_attachment_police" name="file_attachment_police"
                                                                   class="btn btn-success" multiple>
                                                            <button type="button" id="btnAttachmentPolice" class="btn btn-primary"><i
                                                                        class="fa fa-paperclip"></i> Attach files
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>{{--Form End -- Police Character certificate --}}
                                        <form id="Form_Attach_Other" method="post" action="javascript:void(0)"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card card-danger card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Other
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseSix" class="collapse file_attachment_other" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-xs-12" id="show_attachment_other">
                                                            @if(count($file_other) > 0)
                                                                @foreach ($file_other as $nic)
                                                                    <div class="row col-md-12">
                                                                        <ul>
                                                                            <li>
                                                                                @php
                                                                                $img_extension = explode('.',$nic->file_name);
                                                                                $pic_arr = ['jpg','jpeg','png','gif','JPG','JPEG','PNG'];
                                                                                @endphp
                                                                                @if(in_array($img_extension[1],$pic_arr))
                                                                                    <img class="brand-image img-circle elevation-3" style="width: 7%; border: solid #b3d7ff"
                                                                                         src={{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}>
                                                                                @else
                                                                                    @if($img_extension[1] == 'docx')
                                                                                        <i class="fas fa-file-word text-primary"></i>
                                                                                    @elseif($img_extension[1] == 'pdf')
                                                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'ppt')
                                                                                        <i class="fas fa-file-powertpoint text-danger"></i>
                                                                                    @elseif($img_extension[1] == 'xlsx' || $img_extension[1] == 'xlx')
                                                                                        <i class="fas fa-file-excel text-success"></i>
                                                                                    @elseif($img_extension[1] == 'zip')
                                                                                        <i class="fas fa-file-archive text-muted"></i>
                                                                                    @else
                                                                                        <i class="fas fa-file text-primary"></i>
                                                                                    @endif
                                                                                @endif
                                                                                &nbsp;&nbsp;
                                                                                <a href="{{asset("/storage/screening_attachments/".$nic->screening_detail_id."/".$nic->file_name)}}" target="_blank">
                                                                                    {{$nic->attachment}} &nbsp;&nbsp;- Created by {{$nic->created_by}} at {{$nic->created_at}}
                                                                                </a>
                                                                                @if($nic->allow_edit == true && $screening->screening_status == 1)
                                                                                    &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                @else
                                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_role_id == '1' || \Illuminate\Support\Facades\Auth::user()->user_role_id == '4')
                                                                                        &nbsp;&nbsp;<a href="#" class="deleteAttachment" data-id="{{$nic->id}}">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <input type="file" id="file_attachment_other" name="file_attachment_other"
                                                                   class="btn btn-success" multiple>
                                                            <button type="button" id="btnAttachmentOther" class="btn btn-primary"><i
                                                                        class="fa fa-paperclip"></i> Attach files
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>{{--Form End -- Other --}}

                                    </div>

                                </div>

                            </section>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-purple card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-share"></i> Status History</h3>
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
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>

                                            <tr>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>Status Date</th>
                                                <th>Created</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($screening->screeningStatusLogId as $status)
                                                <tr>
                                                    <td>@if($status->screening_status_id == 1)
                                                            <span>Pending</span>
                                                            {{--@elseif($status->screening_status_id == 2)
                                                                <span>In-progress</span>--}}
                                                        @elseif($status->screening_status_id == 2)
                                                            <span>Completed</span>
                                                        @endif</td>
                                                    <td>{{$status->description}}</td>
                                                    <td>{{$status->status_date}}</td>
                                                    <td>{{$status->createdById->name}}<br>{{$status->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h1 class="card-title"><i class="fas fa-comment-medical"></i> Comments</h1>
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
                                    <div class="col-md-12">
                                        <div class="col-md-12" id="feedback">
                                        </div>

                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea type="text" class="form-control" name="description_comment" id="description_comment" rows="4"></textarea>
                                        </div>

                                    </div>
                                </div>

                            </section>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="btn-group">
                                <button class="btn btn-primary" type="button" id="btnAddComment" disabled="disabled"><i
                                            class="fa fa-plus-circle"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{--<div class="modal fade" id="modal-default-inprogress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Status Marking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('/update_modal_inprogress')}}">
                @csrf
                <div class="modal-body">
                    <div>
                        <input type="text" disabled name="status" value="Pending" class="form-control">

                        <input type="hidden" name="screening_status_id" value="{{$screening->screening_status}}"
                               class="form-control">
                        <input type="hidden" name="screening_detail_id" value="{{$screening->id}}"
                               class="form-control">
                    </div>
                    <br>
                    <label>Status Date</label>
                    <div class="input-group date" id="status_date" data-target-input="nearest">
                        <input type="date" class="form-control input-medium"
                               name="status_date" id="status_date" placeholder="Enter Date" min="1919-04-10" max="5020-04-20"/>
                        <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">

                        </div>
                    </div>
                    <br>
                    <div>
                        <textarea  type="text" id="comment" name="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Mark Status</button>
                </div>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>--}}


<div class="modal fade" id="modal-default-completed">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Status Marking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('/update_modal_completed')}}">
                @csrf
                <div>
                    {{--<input type="text" disabled name="status" value="Pending" class="form-control">--}}
                    <input type="hidden" name="screening_status_id" value="{{$screening->screening_status}}"
                           class="form-control">
                    <input type="hidden" name="screening_detail_id" value="{{$screening->id}}"
                           class="form-control">
                </div>


                <div class="modal-body">
                    <div class="row">
                        {{--<div class="col-md-6">
                            <div class="form-group">
                                <label>Status Date<span style="color: #ff0000">*</span></label>
                                <input type="date" class="form-control input-medium" data-target="#dob"
                                       name="status_date" id="status_date" placeholder="Enter Date" required/>
                                <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">

                                </div>
                            </div>
                        </div>--}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Result:<span style="color: #ff0000">*</span></label>
                                <select class="form-control select2" name="screening_result" id="screening_result" @error('screening_result') is-invalid @enderror style="width: 100%;" required>
                                    <option value="">Select Result</option>
                                    <option value="NMF">NMF (No Match Found)</option>
                                    <option value="FMF">FMF (False Match Found)</option>
                                    <option value="PMF">PMF (Possible Match Found)</option>
                                    {{--<option value="PTMF">PTMF</option>
                                    <option value="MIR">MIR</option>--}}

                                </select>
                                @error('screening_result')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <label>Screening Date<span style="color: #ff0000">*</span></label>
                    <div class="input-group date" id="screening_date" data-target-input="nearest">
                        <input type="date" class="form-control input-medium" data-target="#dob"
                               name="screening_date" id="screening_date" placeholder="Screening Date" required 
                               min="1919-04-10" max="5020-04-20"/>
                        <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                        </div>
                    </div>
                    <br>
                    <label>Comment<span style="color: #ff0000">*</span></label>
                    <div>
                        <textarea  type="text" name="comment" id="comment" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Mark Status</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
{{--<script src={{asset("js/common.js")}}></script>--}}
@include('js.common')
@include('js.setting.screening.Attachment')
@include('js.setting.screening.ScreeningComment')
{{--<script src={{asset("js/setting/screening/Attachment.js")}}></script>--}}

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


    $(document).ready(function () {
        $(document).ready(function() {


            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var file_nic = "{{ json_encode($file_nic) }}";
            var file_resume = "{{ json_encode($file_resume) }}";
            var file_qualification = "{{ json_encode($file_qualification) }}";
            var file_experience = "{{ json_encode($file_experience) }}";
            var file_police = "{{ json_encode($file_police) }}";
            var file_other = "{{ json_encode($file_other) }}";

            console.log('nic'+file_nic.length);
            console.log('resume'+file_resume.length);
            console.log('qual'+file_qualification.length);
            console.log('exp'+file_experience.length);
            console.log('police'+file_police.length);
            console.log('other'+file_other.length);


            //---by default the length is 2 that's why check after 2.
            if(file_nic.length > 2
                    || file_resume.length > 2
                    || file_qualification.length > 2
                    || file_experience.length > 2
                    || file_police.length > 2
                    || file_other.length > 2
            )
            {
                //---comments
            }
            else
            {
                Toast.fire({
                    icon: 'success',
                    title: 'Form has been saved but fill attachments below..'
                });
            }




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


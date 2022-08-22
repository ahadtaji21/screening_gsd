@extends('customlayouts.master2')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Info of {{$employees->employee_name}} {{$employees->employee_surname ?? ''}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('employee_list') }}">Employee Screening</a></li>
                        <li class="breadcrumb-item active">View Employee and Screening Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <!-- /.card -->

            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> Employee Info</h3>
                    <div class="card-tools">

                        <a href="{{ url('employee_info_edit',$employees->id) }}">
                            <button type="button" class="btn btn-info bg-gradient-secondary btn-sm"
                                    data-toggle="tooltip" data-placement="bottom" title="Edit Employee Records">
                                <i class="fa fa-edit"></i> Edit Employee
                            </button>
                        </a>

                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-12">
                                <form id="ShowScreeningDetail">
                                    <input type="hidden" id="employee_info_id" name="employee_info_id"
                                           value="{{ $employees->id }}">
                                    <input type="hidden" id="employee_name" name="employee_name"
                                           value="{{ $employees->employee_name }}">

                                    <!-- /.card-header -->
                                    <div class="row">
                                        {{--<div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference No:</label>
                                                <span id="reference_no">{{$employees->reference_no}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Employee Name:</label>
                                                <span id="employee_name">{{$employees->employee_name}}</span>
                                            </div>
                                        </div>--}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Employee First Name:</label>
                                                <span id="employee_name">{{$employees->employee_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Employee Surname:</label>
                                                <span id="employee_surname">{{$employees->employee_surname ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Father First Name: </label>
                                                <span id="father_name">{{$employees->father_name ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Father Surname: </label>
                                                <span id="father_surname">{{$employees->father_surname ?? ''}}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>DOB:</label>
                                                <span id="dob">{{$employees->dob}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email: </label>
                                                <span id="email">{{$employees->email ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Gender: </label>
                                                <span id="gender_id">{{$employees->gender}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Birth Country: </label>
                                                <span id="country_of_birth_name">{{$employees->countries->name ?? ''}}</span>
                                            </div>
                                        </div>
                                        {{--<div class="col-md-3">
                                            <div class="form-group">
                                                <label>Region: </label>
                                                <span id="passport">{{$employees->regionId->name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Residence (FO):</label>
                                                <span id="field_office_name">{{$employees->field_office->name}}</span>
                                            </div>
                                        </div>--}}


                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NIC: </label>
                                                <span id="nic">{{$employees->nic ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Passport: </label>
                                                <span id="passport">{{$employees->passport ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nationality:</label>
                                                <span id="nationality_name">{{$employees->nationalityId->name ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Ethnicity: </label>
                                                <span id="ethnicity_name">{{$employees->ethnicity ?? ''}}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address: </label>
                                                <span id="address">{{$employees->address ?? ''}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                            <span id="created_by_name"><i>This employee record has been
                                                    created by <strong>{{$employees->createdById->name}}</strong>
                                                    at <strong>{{$employees->created_at}}</strong>
                                                    @if($employees->updated_by)
                                                        , and recently updated by <strong>{{$employees->createdById->name}}</strong> at <strong>{{$employees->updated_at}}</strong>.
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

                    </section>
                </div>
                <!-- /.card-body -->
            </div>

            <!-- Table -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-paperclip"></i> Screenings List</h3>
                    @if ($add_screening)
                        <div class="card-tools">
                            <a href="{{ url('screening_add',$employees->id) }}">
                                <button type="button" class="btn btn-info bg-gradient-primary btn-sm"
                                        data-toggle="tooltip" data-placement="bottom" title="Add Screening">
                                    <i class="fa fa-plus"></i> Add Screening of {{$employees->employee_name}}
                                </button>
                            </a>

                            {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>--}}
                        </div>
                    @else
                        <div class="card-tools">
                            <span class="badge badge-danger">
                                The screening is in under process, so can not add new screening
                            </span>
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-12 table-responsive" id="accordion">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>Ref.no</th>
                                        <th>Region - FO</th>
                                        <th>Staff Type</th>
                                        <th>Job Title</th>
                                        <th>Dept</th>

                                        <th>Status</th>
                                        <th>Result</th>
                                        <th>Dated</th>

                                        <th>Record Status</th>
                                        <th>Emp Status</th>
                                        <th>Line Manager Title</th>
                                        <th>C.Start Date</th>
                                        <th>C.End Date</th>
                                        <th>Comments</th>

                                        <th>On Behalf</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($employees->screening as $screening)
                                        <tr id="tr_{{$screening->id}}">
                                            <input type="hidden" class="serdelete_val" value="{{ $screening->id }}">
                                            <td>{{$screening->id}}</td>
                                            <td>{{$screening->reference_no}}</td>
                                            <td>{{$screening->regionId->name ?? 'null'}} - <br> {{$screening->field_office->name ?? 'null'}}</td>
                                            <td>{{$screening->type_of_staff}}</td>
                                            <td>{{$screening->designationsId->name}}</td>
                                            <td>{{$screening->departmentsId->name}}</td>

                                            <td>
                                                @if($screening->screening_status == 1)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($screening->screening_status == 2)
                                                    <span class="badge badge-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>{{$screening->screening_result}}</td>
                                            <td>{{$screening->screening_date}}</td>

                                            <td>
                                                @if($screening->record_status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($screening->record_status == 2)
                                                    <span class="badge badge-danger">Archive</span>
                                                @endif
                                            </td>
                                            {{--<td>{{$screening->record_status}}</td>--}}
                                            <td>
                                                @if($screening->employee_status == 0)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($screening->employee_status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($screening->employee_status == 2)
                                                    <span class="badge badge-danger">Left</span>
                                                @endif
                                            </td>
                                            <td>{{$screening->lineManagerDesignationsId->name}}</td>
                                            <td>{{$screening->contract_start_date}}</td>
                                            <td>{{$screening->contract_end_date}}</td>
                                            <td>{{$screening->comments}}</td>

                                            <td>{{$screening->onBehalfUserId->name ?? ''}}</td>
                                            <td>{{$screening->created_at}}</td>
                                            <td>{{$screening->scCreatedById->name}}</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    @if($screening->employee_status != 2)
                                                        @if($screening->screening_status == 2 && $screening->employee_status == 0)
                                                            <a href="{{ url('screening_edit/'.$employees->id.'/'.$screening->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Screening & Mark Employee Status">
                                                                <i class="fas fa-pen-nib"></i>
                                                                <span class="badge badge-warning"><i class="fa fa-exclamation-triangle"></i> </span>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('screening_edit/'.$employees->id.'/'.$screening->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Screening Record">
                                                                <i class="fas fa-pen-nib"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ url('screening_view/'.$screening->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="View Screening Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    @if(($screening->screening_status == 1) && (Auth::user()->user_role_id == 1 || Auth::user()->user_role_id == 4))
                                                        <button type="button" class="btn btn-sm btn-danger DeleteScreening" data-id="{{$screening->id}}"
                                                                data-toggle="tooltip" data-placement="bottom" title="Delete Screening">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    @if($screening->employee_status == 1)
                                                        <button type="button" class="btn btn-sm btn-danger LeaverEmployee" data-id="{{$screening->id}}" data-designation="{{$screening->designationsId->name}}"
                                                                data-toggle="tooltip" data-placement="bottom" title="Mark Leaver">
                                                            <i class="fa fa-ban"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
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
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     id="LeaverModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mark Leaver</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="Form_Mark_leaver" method="post" action="{{url('/update_modal_leaver')}}">
                @csrf
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="screening_detail_id" id="screening_detail_id_modal" class="form-control">
                        <input type="hidden" name="employee_info_id" id="employee_info_id_modal" class="form-control">
                    </div>
                    <br>
                    <label>Detail</label>
                    <input type="text" name="detail" id="detail_modal" class="form-control" disabled>
                    <br>
                    <label>Leaver Date</label>
                    <div class="input-group date" id="employee_status_dated" data-target-input="nearest">
                        <input type="date" class="form-control input-medium" data-target="#dob"
                               name="employee_status_dated" id="employee_status_dated" placeholder="Enter Date"/>
                        <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">

                        </div>
                    </div>
                    <br>
                    <label>Leaving Comments</label>
                    <div>
                        <textarea  type="text" name="comment" id="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Mark Leaver</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
<script src={{asset("js/common.js")}}></script>


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
            "responsive": true
        });


        $( "#example1 tbody" ).on( "click", ".LeaverEmployee", function(e){
            var screeningId = $(this).attr('data-id');
            var designation = $(this).attr('data-designation');
            var employeeInfoId = $('#employee_info_id').val();
            var employee_name = $('#employee_name').val();

            var detail = employee_name + ' ('+ designation +') ';
            //alert(detail);
            var form_mark_leaver = $('#Form_Mark_leaver');

            var screeningIdFld = $('#screening_detail_id_modal', form_mark_leaver);
            var employeeIdFld = $('#employee_info_id_modal', form_mark_leaver);
            var detailFld = $('#detail_modal', form_mark_leaver);



            $('#LeaverModal').modal('show');
            screeningIdFld.val(screeningId);
            employeeIdFld.val(employeeInfoId);
            detailFld.val(detail);

        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });


        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="cdrf-token"]').attr('content')
            }
        });

        $( "#example1 tbody" ).on( "click", ".DeleteScreening", function(e){
            e.preventDefault();

            var screeningId = $(this).attr('data-id');
            //alert(screeningId);

            //----- SWAL Section -----
            Swal.fire({
                title: "Are you sure you want to delete screening",
                text: "Continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then(function (result) {
                if (result.isConfirmed)
                {
                    var data = {
                        "_token": $('input[name=_token]').val(),
                        "id": screeningId
                    };

                    var url = '{{ route("delete_screening", ":id") }}';
                    url = url.replace(':id', screeningId );

                    $.ajax({
                        type: "get",
                        url: url,
                        data: data,
                        success: function (response) {
                            location.reload();

                            Toast.fire({
                                icon: 'success',
                                title: 'The screening has been deleted successfully'
                            });
                        }
                    });
                }
            });//--- swal ends

        });//--- end delete btn click




    });
</script>

@endsection


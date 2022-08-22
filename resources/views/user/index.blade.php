@extends('customlayouts.master2')

@section('content')

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->

            <!-- Table -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users-cog"></i> User Details</h3>
                    <div class="card-tools">
                        <a href="{{url('/user_add')}}" class="btn btn-outline-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fas fa-user-plus"></i> Add New User</a>
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="UserGrid" class="table table-bordered table-striped table-hover">
                        <thead>

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Department</th>
                            <th>Job title</th>
                            <th>Region</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $u)
                            <tr id="tr_{{$u->id}}">
                                <input type="hidden" class="serdelete_val" value="{{ $u->id }}">
                                <input type="hidden" class="serdelete_name" value="{{ $u->name }}">
                                <td>{{ $u->id }}</td>
                                <td>
                                    @if($u->status == '1')
                                        <span class="badge badge-warning"> <i title="Pending" class="fas fa-exclamation"></i></span>
                                    @elseif($u->status == '2')
                                        <span class="badge badge-success"> <i title="Unlock" class="fas fa-check"></i></span>
                                    @elseif($u->status == '3')
                                        <span class="badge badge-danger"> <i title="Locked" class="fas fa-ban"></i></span>
                                    @endif

                                    {{ $u->name }}


                                </td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->departmentId->name }}</td>
                                <td>{{ $u->designationId->name }}</td>
                                <td>{{ $u->regionId->name }}
                                    @if ($u->office_name !== '')
                                        ({{$u->office_name}})
                                    @endif
                                </td>                               
                                <td>
                                    @if($u->user_role_id == '1')
                                        <span>Administrator</span>
                                    @elseif($u->user_role_id == '2')
                                        <span>Operator</span>
                                    @elseif($u->user_role_id == '3')
                                        <span>Viewer</span>
                                    @elseif($u->user_role_id == '4')
                                        <span>SuperAdmin</span>
                                    @endif
                                </td>
                                <td>{{ $u->created_at }}</td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{url("/user_edit/".$u->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pen-nib"></i></a>
                                        {{--<a href="{{"/delete_user/".$u->id}}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></a>--}}
                                        <button class="btn btn-danger deletebtn" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>


                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src={{asset("plugins/jquery/jquery.min.js")}}></script>


<script>
    $(function () {
        $("#UserGrid").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#UserGrid_wrapper .col-md-6:eq(0)');
        $('#UserGrid2').DataTable({
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
<script>
    $(document).ready(function (){

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

        $( "#UserGrid tbody" ).on( "click", ".deletebtn", function(e){
        //$(".deletebtn").click(function (e) {
            e.preventDefault();

            var delete_id = $(this).closest('tr').find('.serdelete_val').val();
            var delete_name = $(this).closest('tr').find('.serdelete_name').val();
            //alert(delete_id);

            //----- SWAL Section -----
            Swal.fire({
                title: "This will permanently deleted",
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
                        "name": delete_name
                    };

                    var url = '{{ route("delete_user", ":id") }}';
                    url = url.replace(':id', delete_id );

                    $.ajax({
                        type: "get",
                        url: url,
                        data: data,
                        success: function (response) {
                            location.reload();
                            Toast.fire({
                                icon: 'success',
                                title: delete_name+' user has been deleted successfully'
                            });
                            /*Swal(response.status,{
                             icon:"success",

                             })
                             .then(function (result){
                             location.reload();
                             });*/
                        }
                    });
                }
            });//--- swal ends


        });//--- end delete btn click
    });
</script>

@endsection


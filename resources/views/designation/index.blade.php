@extends('customlayouts.master2')

@section('content')

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Title Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Job Title</a></li>
                        <li class="breadcrumb-item active">Job Title Details</li>
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
                    <h3 class="card-title"><i class="fas fa-th"></i> Job Title Details</h3>
                    <div class="card-tools">
                        <a href="{{url('/add_designation')}}" class="btn btn-outline-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fas fa-pen"></i> Add New Job Title</a>
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="Deptgrid" class="table table-bordered table-striped">
                        <thead>

                        <tr>
                            <th>ID</th>
                            <th>Job Title</th>
                            <th>Created by</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($designation as $dept)
                            <tr id="tr_{{$dept->id}}">
                                <input type="hidden" class="serdelete_val" value="{{ $dept->id }}">
                                <input type="hidden" class="serdelete_name" value="{{ $dept->name }}">
                                <td>{{ $dept->id }}</td>
                                <td>{{ $dept->name }}</td>
                                <td>{{ $dept->created }}</td>
                                <td>{{ $dept->created_at }}</td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{url("/edit_designation/".$dept->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pen-nib"></i></a>
                                        {{--<a href="{{"/delete_designation/".$dept->id}}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></a>--}}
                                        @if(Auth::user()->user_role_id == 1 || Auth::user()->user_role_id == 4)
                                            <button class="btn btn-danger deletebtn" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></button>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
        $("#Deptgrid").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#Deptgrid_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
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

        $( "#Deptgrid tbody" ).on( "click", ".deletebtn", function(e){
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

                    var url = '{{ route("delete_designation", ":id") }}';
                    url = url.replace(':id', delete_id );

                    $.ajax({
                        type: "get",
                        url: url,
                        data: data,
                        success: function (response) {
                            location.reload();
                           /* var table = $('#Deptgrid').DataTable();
                            var tr = $('#Deptgrid tbody tr:eq(0)');
                            tr.find('td:eq(0)').html( 'Updated' );
                            table.rows(tr).invalidate().draw();*/

                            Toast.fire({
                                icon: 'success',
                                title: delete_name+' job title has been deleted successfully'
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


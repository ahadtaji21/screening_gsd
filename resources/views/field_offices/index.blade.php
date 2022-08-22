@extends('customlayouts.master2')

@section('content')

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Field Offices Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Field Offices</a></li>
                        <li class="breadcrumb-item active">Details</li>
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
                    <h3 class="card-title"><i class="fas fa-th"></i> Field Offices</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="field_officegrid" class="table table-bordered table-striped">
                        <thead>

                        <tr>
                            <th>ID</th>
                            <th>Region</th>
                            <th>Field Office</th>
                            <th>Acronym</th>
                            <th>Sequence #</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($field_offices as $field_office)
                            <tr>
                                <td>{{ $field_office->id }}</td>
                                <td>{{ $field_office->regionID->name }}</td>
                                <td>{{ $field_office->name }}</td>
                                <td>{{ $field_office->acronym }}</td>
                                <td>{{ $field_office->acronym }}{{ $field_office->sequence_number }}</td>
                                <td>{{ $field_office->created_at }}</td>
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
        $("#field_officegrid").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#field_officegrid_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>

@endsection


@extends('customlayouts.master2')

@section('content')

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Que Job</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Que Job</a></li>
                        <li class="breadcrumb-item active">Que Job List</li>
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

            <div class="card card-info card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fa fa-user-cog"></i> Jobs</a>
                        </li>
                        @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fa fa-file-archive"></i> failed Jobs</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel"
                             aria-labelledby="custom-tabs-two-home-tab">
                            <div class="card-body">
                                <table id="LoginLogReportGrid" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Queue</th>
                                        <th>Payload</th>
                                        <th>Attempts</th>
                                        <th>Reserved_at</th>
                                        <th>Available_at</th>
                                        <th>Created_at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($jobs as $u)
                                        <tr id="tr_{{$u->id}}">
                                            <td>{{ $u->id }}</td>
                                            <td>{{ $u->queue }}</td>
                                            <td style="word-break: break-all">{{ $u->payload }}</td>
                                            <td>{{ $u->attempts }}</td>
                                            <td>{{ $u->reserved_at }}</td>
                                            <td>{{ $u->available_at }}</td>
                                            <td>{{ $u->created_at }}</td>                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                             aria-labelledby="custom-tabs-two-profile-tab">
                            <div class="card-body">
                                <table id="LoginLogDetailGrid" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>uuid</th>
                                        <th>Connection</th>
                                        <th>Queue</th>
                                        <th>Payload</th>
                                        <th>Exception</th>
                                        <th>Failed_at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($failed_jobs as $r)
                                        <tr id="">
                                            <td>{{ $r->id }}</td>
                                            <td>{{ $r->uuid }}</td>
                                            <td>{{ $r->connection }}</td>
                                            <td>{{ $r->queue }}</td>
                                            <td style="word-break: break-all">{{ $r->payload }}</td>
                                            <td style="word-break: break-all">{{ $r->exception }}</td>
                                            <td>{{ $r->failed_at }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
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
<script src={{asset("plugins/jquery/jquery.min.js")}}></script>

<script>
    $(function () {
        $("#LoginLogDetailGrid").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#LoginLogDetailGrid_wrapper .col-md-6:eq(0)');
        $('#LoginLogDetailGrid2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $("#LoginLogReportGrid").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#LoginLogReportGrid_wrapper .col-md-6:eq(0)');
        $('#LoginLogReportGrid2').DataTable({
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


@endsection


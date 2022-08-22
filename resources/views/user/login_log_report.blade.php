@extends('customlayouts.master2')

@section('content')

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Login Log Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Login Log Report</li>
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
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fa fa-user-cog"></i> Login Log Details</a>
                        </li>
                        @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fa fa-file-archive"></i> Login Log Report</a>
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
                                        <th>Created</th>
                                        <th>UserID</th>
                                        <th>Username</th>
                                        <th>IP</th>
                                        <th>Login Status</th>
                                        <th>Url</th>
                                        <th>System</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($login_log_report as $u)
                                        <tr id="tr_{{$u->id}}">
                                            <td>{{ $u->created_at->format('M-d-Y H:i:s') }}</td>
                                            <td>{{ $u->user_id }}</td>
                                            <td>{{ $u->user_name }}</td>
                                            <td>{{ $u->ip }}</td>
                                            <td class="project-state">
                                                @if($u->login_status == 'true')
                                                    <span class="badge badge-success">True</span>
                                                @else
                                                    <span class="badge badge-danger">False</span>
                                                @endif
                                            </td>
                                            <td>{{ $u->url }}</td>
                                            <td>{{ $u->sys_name }}</td>
                                        </tr>
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
                                        <th>Month</th>
                                        <th>Successfull logins</th>
                                        <th>Unique Visitors</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($reports as $r)
                                        <tr id="">
                                            <td>{{ $r->yearMonth }}</td>
                                            <td>{{ $r->successfull_login }}</td>
                                            <td>{{ $r->unique_visitor }}</td>
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
            "responsive": true, "lengthChange": false, "autoWidth": false, "ordering":false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#LoginLogReportGrid_wrapper .col-md-6:eq(0)');

    });
</script>


@endsection


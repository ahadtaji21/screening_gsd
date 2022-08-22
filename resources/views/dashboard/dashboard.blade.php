  @extends('customlayouts.master2')


@section('content')
          <style type="text/css">
            .east_africa_img{
              background: url({{asset('/dist/img/east_africa_region_new2.jpg')}}) center;
              background-repeat: no-repeat;
              width: 100%;
              background-size: cover;
            }

            .west_africa_img{
              background: url({{asset('/dist/img/west_africa_region_new.png')}}) center;
              background-repeat: no-repeat;
              width:100%;
              background-size: cover;
            }

            .asia_img{
              background: url({{asset('/dist/img/asia_region.png')}}) center;
              background-repeat: no-repeat;
              width: 100%;
              background-size: cover;
            }

            .menaee_img{
              background: url({{asset('/dist/img/menaee_region_new.png')}}) center;
              background-repeat: no-repeat;

              background-size: cover;
            }
          </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    {{--<div class="row">
      <div class="col-md-12 alert alert-danger">
        @include('flash::message')
      </div>
    </div>--}}


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h4><strong>{{$pending}}</strong></h4>

                <p>Pending Screening</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('employee_list_pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          @if(Auth::user()->user_role_id == '1' || Auth::user()->user_role_id == '4')
            {{--for Administrator Role--}}
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                <h4><strong>{{$yellow_count}} - {{$red_count}} <sup style="font-size: 12px">Pending Screening</sup></strong></h4>

                  <p>
                    <span class="badge bg-warning" data-toggle="tooltip" data-placement="bottom" title="3 days past, no action taken">
                      Yellow
                    </span> <strong>-</strong>
                    <span class="badge bg-danger" data-toggle="tooltip" data-placement="bottom" title="4 days past, no action taken">
                      Red
                    </span>
                    &nbsp;(Screening)
                  </p>
                </div>
                <div class="icon">
                  {{--<i class="ion ion-stats-bars"></i>--}}
                </div>
                <a href="{{route('employee_list_pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                <h4><strong>{{$completed_active}} - {{$completed_archive}}</strong></h4>

                  <p>Completed - Archive</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('employee_list_completed')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            {{--for Operator and Viewer role--}}
          @else
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                <h4><strong>{{$completed_active}}{{--<sup style="font-size: 20px">%</sup>--}}</strong></h4>

                  <p>Completed Screening</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('employee_list_completed')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                <h4><strong>{{$completed_archive}}</strong></h4>

                  <p>Archive Completed Screening</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('employee_list_completed')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @endif

          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><strong>{{$total}} - {{$total_emp}}</strong></h4>

                <p>Total Screening - Total Employee</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              {{--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
              <h4><strong>{{$current}} - {{$leaver}}</strong></h4>

                <p>Current Employees - Leaver Employees</p>
              </div>
              <div class="icon">
                <i class="fas fa-child"></i>
                {{--<i class="ion ion-pie-graph"></i>--}}
              </div>
              {{--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <h4><strong>{{$male}} - {{$female}} - {{$other}}</strong></h4>

                <p>Male - Female - other</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-ninja"></i>
                {{--<i class="ion ion-pie-graph"></i>--}}
              </div>
              <a href="{{route('employee_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- Info boxes (Stat box) -->
        <div class="row">

        @foreach($employee_type as $key=>$val)
        
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="info-box">
              <span class="info-box-icon 
              
              @if($loop->first)
                bg-pink
              @elseif($loop->last)
                bg-olive
              @elseif($loop->iteration === 3)
                bg-lime
              @elseif($loop->iteration === 4)
                bg-primary  
              @elseif($loop->even)
                bg-purple
              @elseif($loop->odd)
                bg-warning                  
              @endif
              
              "><i class="far fa-user"></i></span>
              <a href="{{route('employee_list_'.$key)}}" style="color: black">
                <div class="info-box-content">
                  <span class="info-box-text">{{ $key }}</span>
                  <span class="info-box-number">{{ $val }}</span>
                </div>
              </a>

              <!-- /.info-box-content -->
            </div>
          </div>
          
        @endforeach
        </div>

        <!-- Image boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white east_africa_img">
                {{--<img src="{{asset('dist/img/east_africa_region.jfif')}}">--}}

                {{--<a href="">
                  <h1 class="widget-user-desc text-right" data-toggle="tooltip" data-placement="bottom" title="East Africa Region">
                    <strong style="color: green; margin-right: -100px"><span style="margin-right: -93px">East</span><br>Africa</strong>
                  </h1>
                </a>--}}
              </div>

              <div class="card-footer" style="padding-top: 10px">
                <a href="{{route('employee_list_east_africa')}}">
                <h2 data-toggle="tooltip" data-placement="bottom" title="East Africa Region">
                  <strong style="color: green";>East Africa</strong>
                </h2>
                </a>
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->pending_east_africa}}</h5>
                      <span>Pending</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_active_east_africa}}</h5>
                      <span>Completed</span><br><small class="badge bg-success">Active</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_archive_east_africa}}</h5>
                      <span>Completed</span><br><small class="badge bg-warning">Archive</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <div class="col-lg-3 col-6">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white west_africa_img">
                {{--<img src="{{asset('dist/img/east_africa_region.jfif')}}">--}}

                {{--<a href="">
                  <h1 class="widget-user-desc text-right" data-toggle="tooltip" data-placement="bottom" title="West Africa Region">
                    <strong style="color: blue; margin-right: -100px"><span style="margin-right: -93px">West</span><br>Africa</strong>
                  </h1>
                </a>--}}
              </div>

              <div class="card-footer" style="padding-top: 10px">
                <a href="{{route('employee_list_west_africa')}}">
                <h2 data-toggle="tooltip" data-placement="bottom" title="West Africa Region">
                  <strong style="color: blue;">West Africa</strong>
                </h2>
                </a>
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->pending_west_africa}}</h5>
                      <span >Pending</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_active_west_africa}}</h5>
                      <span >Completed</span><br><small class="badge bg-success">Active</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_archive_west_africa}}</h5>
                      <span >Completed</span><br><small class="badge bg-warning">Archive</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <div class="col-lg-3 col-6">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white asia_img">
                {{--<img src="{{asset('dist/img/east_africa_region.jfif')}}">--}}

                {{--<a href="">
                  <h1 class="widget-user-desc text-right" data-toggle="tooltip" data-placement="bottom" title="Asia Region">
                    <strong style="color: orange; margin-right: -100px">Asia</strong>
                  </h1>
                </a>--}}
              </div>

              <div class="card-footer" style="padding-top: 10px">
                <a href="{{route('employee_list_asia')}}">
                <h2 data-toggle="tooltip" data-placement="bottom" title="Asia Region">
                  <strong style="color: orange";>Asia</strong>
                </h2>
                </a>
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->pending_asia}}</h5>
                      <span >Pending</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_active_asia}}</h5>
                      <span >Completed</span><br><small class="badge bg-success">Active</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_archive_asia}}</h5>
                      <span >Completed</span><br><small class="badge bg-warning">Archive</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <div class="col-lg-3 col-6">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white menaee_img">
                {{--<img src="{{asset('dist/img/east_africa_region.jfif')}}">--}}

                {{--<a href="">
                  <h1 class="widget-user-desc text-right" data-toggle="tooltip" data-placement="bottom" title="MENAEE Region">
                    <strong style="color: deeppink; margin-right: 119px;"><br>MENAEE</strong>
                  </h1>
                </a>--}}
              </div>

              <div class="card-footer" style="padding-top: 10px">
                <a href="{{route('employee_list_menaee')}}">
                <h2 data-toggle="tooltip" data-placement="bottom" title="MENAEE Region">
                  <strong style="color: #605ca8";>MENAEE</strong>
                </h2>
                </a>
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->pending_menaee}}</h5>
                      <span >Pending</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_active_menaee}}</h5>
                      <span >Completed</span><br><small class="badge bg-success">Active</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$count_status_region[0]->completed_archive_menaee}}</h5>
                      <span >Completed</span><br><small class="badge bg-warning">Archive</small>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->

          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-3 connectedSortable">
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">By Staff/ By Gender</h3>

                {{--<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>--}}
              </div>
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td><i class="fa fa-user"></i> &nbsp;Current</td>
                    <td>{{$count_emp_region[0]->current_east_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-minus"></i> &nbsp;Leaver</td>
                    <td>{{$count_emp_region[0]->leaver_east_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-male"></i> &nbsp;Male</td>
                    <td>{{$male_east_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-female"></i> &nbsp;Female</td>
                    <td>{{$female_east_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-alt-slash"></i> &nbsp;Other</td>
                    <td>{{$other_east_africa}}</td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <small><strong><span style="color: red">*</span> Volunteers excluded</strong></small>
              </div>
            </div>
          </section>
          <section class="col-lg-3 connectedSortable">
            <!-- BAR CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">By Staff/ By Gender</h3>

                {{--<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>--}}
              </div>
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td><i class="fa fa-user"></i> &nbsp;Current</td>
                    <td>{{$count_emp_region[0]->current_west_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-minus"></i> &nbsp;Leaver</td>
                    <td>{{$count_emp_region[0]->leaver_west_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-male"></i> &nbsp;Male</td>
                    <td>{{$male_west_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-female"></i> &nbsp;Female</td>
                    <td>{{$female_west_africa}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-alt-slash"></i> &nbsp;Other</td>
                    <td>{{$other_west_africa}}</td>
                  </tr>
                </table>
              </div>
              <div class="card-footer">
                <small><strong><span style="color: red">*</span> Volunteers excluded</strong></small>
              </div>
              <!-- /.card-body -->
            </div>
          </section>
          <section class="col-lg-3 connectedSortable">
            <!-- BAR CHART -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">By Staff/ By Gender</h3>

                {{--<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>--}}
              </div>
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td><i class="fa fa-user"></i> &nbsp;Current</td>
                    <td>{{$count_emp_region[0]->current_asia}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-minus"></i> &nbsp;Leaver</td>
                    <td>{{$count_emp_region[0]->leaver_asia}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-male"></i> &nbsp;Male</td>
                    <td>{{$male_asia}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-female"></i> &nbsp;Female</td>
                    <td>{{$female_asia}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-alt-slash"></i> &nbsp;Other</td>
                    <td>{{$other_asia}}</td>
                  </tr>
                </table>
              </div>
              <div class="card-footer">
                <small><strong><span style="color: red">*</span> Volunteers excluded</strong></small>
              </div>
              <!-- /.card-body -->
            </div>
          </section>
          <section class="col-lg-3 connectedSortable">
            <!-- BAR CHART -->
            <div class="card card-purple">
              <div class="card-header">
                <h3 class="card-title">By Staff/ By Gender</h3>

                {{--<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>--}}
              </div>
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td><i class="fa fa-user"></i> &nbsp;Current</td>
                    <td>{{$count_emp_region[0]->current_menaee}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-minus"></i> &nbsp;Leaver</td>
                    <td>{{$count_emp_region[0]->leaver_menaee}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-male"></i> &nbsp;Male</td>
                    <td>{{$male_menaee}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-female"></i> &nbsp;Female</td>
                    <td>{{$female_menaee}}</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-user-alt-slash"></i> &nbsp;Other</td>
                    <td>{{$other_menaee}}</td>
                  </tr>
                </table>
              </div>
              <div class="card-footer">
                <small><strong><span style="color: red">*</span> Volunteers excluded</strong></small>
              </div>
              <!-- /.card-body -->
            </div>
          </section>
          <!-- right col -->

          <section class="col-lg-3 connectedSortable">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Screening Status of Current Year</h3>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    {{--<span class="text-bold text-lg">$18,230.00</span>
                    <span>Screening Over Time</span>--}}
                  </p>
                  {{--<p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>--}}
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="eastafrica-status-chart" height="200"></canvas>
                </div>

                {{--<div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>--}}
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <small><strong style="color: green">EAST AFRICA</strong></small>
              </div>
            </div>
          </section>

          <section class="col-lg-3 connectedSortable">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Screening Status of Current Year</h3>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    {{--<span class="text-bold text-lg">$18,230.00</span>
                    <span>Screening Over Time</span>--}}
                  </p>
                  {{--<p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>--}}
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="westafrica-status-chart" height="200"></canvas>
                </div>

                {{--<div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>--}}
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <small><strong style="color: blue">WEST AFRICA</strong></small>
              </div>
            </div>
          </section>

          <section class="col-lg-3 connectedSortable">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Screening Status of Current Year</h3>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    {{--<span class="text-bold text-lg">$18,230.00</span>
                    <span>Screening Over Time</span>--}}
                  </p>
                  {{--<p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>--}}
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="asia-status-chart" height="200"></canvas>
                </div>

                {{--<div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>--}}
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <small><strong style="color: orange">ASIA</strong></small>
              </div>
            </div>
          </section>

          <section class="col-lg-3 connectedSortable">
            <div class="card card-purple">
              <div class="card-header">
                <h3 class="card-title">Screening Status of Current Year</h3>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    {{--<span class="text-bold text-lg">$18,230.00</span>
                    <span>Screening Over Time</span>--}}
                  </p>
                  {{--<p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>--}}
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="menaee-status-chart" height="200"></canvas>
                </div>

                {{--<div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>--}}
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <small><strong style="color: #605ca8">MENAEE</strong></small>
              </div>
            </div>
          </section>

          <section class="col-lg-6 connectedSortable">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Overall Screening Status of Current Year</h3>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    {{--<span class="text-bold text-lg">$18,230.00</span>
                    <span>Screening Over Time</span>--}}
                  </p>
                  {{--<p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>--}}
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                {{--<div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>--}}
              </div>
              <!-- /.card-body -->
            </div>
          </section>
          <section class="col-lg-6 connectedSortable">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">Overall Employee Status of Current Year</h3>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    {{--<span class="text-bold text-lg">$18,230.00</span>
                    <span>Screening Over Time</span>--}}
                  </p>
                  {{--<p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>--}}
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="employee-status-chart" height="200"></canvas>
                </div>

                {{--<div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>--}}
              </div>
              <!-- /.card-body -->
            </div>
          </section>

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
          <script src={{asset("plugins/jquery/jquery.min.js")}}></script>
<script src={{asset("plugins/chart.js/Chart.min.js")}}></script>

  <script>
    $(document).ready(function (){
      ajaxGetMonthlyStatusData();
      ajaxGetMonthlyEmployeeStatusData();
      ajaxGetMonthlyEastAfricaStatusData();
      ajaxGetMonthlyWestAfricaStatusData();
      ajaxGetMonthlyAsiaStatusData();
      ajaxGetMonthlyMenaeeStatusData();
    });

    function ajaxGetMonthlyStatusData ()
    {
      $.ajax({
        type:'GET',
        url: "{{url('/get_status_month_chart/')}}",
        success: (function (data) {
          drawChartStatusMonthly(data);
        })
      });
    }


    function drawChartStatusMonthly (response)
    {
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index';
      var intersect = false;

      var salesChart = $('#sales-chart');

      var salesChartNew = new Chart(salesChart, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [
            {
              label: 'Pending',
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: response.status_pending_count
            },
            {
              label: 'Completed',
              //backgroundColor: '#ced4da',
              backgroundColor: '#7fff00',
              borderColor: '#7fff00',
              data: response.status_completed_count
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              /*gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },*/
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      });
    }


    function ajaxGetMonthlyEmployeeStatusData ()
    {
      $.ajax({
        type:'GET',
        url: "{{url('/get_employee_status_month_chart/')}}",
        success: (function (data) {
          drawChartEmployeeStatusMonthly(data);
        })
      });
    }


    function drawChartEmployeeStatusMonthly (response)
    {
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index';
      var intersect = false;

      var employeeStatusChart = $('#employee-status-chart');

      var employeeStatusChartNew = new Chart(employeeStatusChart, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [
            {
              label: 'Current',
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: response.status_current_count
            },
            {
              label: 'Leaver',
              backgroundColor: '#ff7f50',
              borderColor: '#ff7f50',
              data: response.status_leaver_count
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              stacked: true,
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              stacked: true,
              ticks: ticksStyle
            }]
          }
        }
      });
    }



    function ajaxGetMonthlyEastAfricaStatusData ()
    {
      $.ajax({
        type:'GET',
        url: "{{url('/get_eastafrica_status_month_chart/')}}",
        success: (function (data) {
          drawChartEastAfricaStatusMonthly(data);
        })
      });
    }


    function drawChartEastAfricaStatusMonthly (response)
    {
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index';
      var intersect = false;

      var salesChart = $('#eastafrica-status-chart');

      var salesChartNew = new Chart(salesChart, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [
            {
              label: 'Pending',
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: response.east_africa_status_pending_count
            },
            {
              label: 'Completed',
              //backgroundColor: '#ced4da',
              backgroundColor: '#7fff00',
              borderColor: '#7fff00',
              data: response.east_africa_status_completed_count
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              /*gridLines: {
               display: true,
               lineWidth: '4px',
               color: 'rgba(0, 0, 0, .2)',
               zeroLineColor: 'transparent'
               },*/
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      });
    }



    function ajaxGetMonthlyWestAfricaStatusData ()
    {
      $.ajax({
        type:'GET',
        url: "{{url('/get_westafrica_status_month_chart/')}}",
        success: (function (data) {
          drawChartWestAfricaStatusMonthly(data);
        })
      });
    }


    function drawChartWestAfricaStatusMonthly (response)
    {
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index';
      var intersect = false;

      var salesChart = $('#westafrica-status-chart');

      var salesChartNew = new Chart(salesChart, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [
            {
              label: 'Pending',
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: response.west_africa_status_pending_count
            },
            {
              label: 'Completed',
              //backgroundColor: '#ced4da',
              backgroundColor: '#7fff00',
              borderColor: '#7fff00',
              data: response.west_africa_status_completed_count
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              /*gridLines: {
               display: true,
               lineWidth: '4px',
               color: 'rgba(0, 0, 0, .2)',
               zeroLineColor: 'transparent'
               },*/
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      });
    }


    function ajaxGetMonthlyAsiaStatusData ()
    {
      $.ajax({
        type:'GET',
        url: "{{url('/get_asia_status_month_chart/')}}",
        success: (function (data) {
          drawChartAsiaStatusMonthly(data);
        })
      });
    }


    function drawChartAsiaStatusMonthly (response)
    {
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index';
      var intersect = false;

      var salesChart = $('#asia-status-chart');

      var salesChartNew = new Chart(salesChart, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [
            {
              label: 'Pending',
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: response.asia_status_pending_count
            },
            {
              label: 'Completed',
              //backgroundColor: '#ced4da',
              backgroundColor: '#7fff00',
              borderColor: '#7fff00',
              data: response.asia_status_completed_count
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              /*gridLines: {
               display: true,
               lineWidth: '4px',
               color: 'rgba(0, 0, 0, .2)',
               zeroLineColor: 'transparent'
               },*/
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      });
    }


    function ajaxGetMonthlyMenaeeStatusData ()
    {
      $.ajax({
        type:'GET',
        url: "{{url('/get_menaee_status_month_chart/')}}",
        success: (function (data) {
          drawChartMenaeenStatusMonthly(data);
        })
      });
    }


    function drawChartMenaeenStatusMonthly (response)
    {
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index';
      var intersect = false;

      var salesChart = $('#menaee-status-chart');

      var salesChartNew = new Chart(salesChart, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [
            {
              label: 'Pending',
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: response.menaee_status_pending_count
            },
            {
              label: 'Completed',
              //backgroundColor: '#ced4da',
              backgroundColor: '#7fff00',
              borderColor: '#7fff00',
              data: response.menaee_status_completed_count
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              /*gridLines: {
               display: true,
               lineWidth: '4px',
               color: 'rgba(0, 0, 0, .2)',
               zeroLineColor: 'transparent'
               },*/
              ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += 'k'
                  }

                  return value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      });
    }



  </script>
  @endsection


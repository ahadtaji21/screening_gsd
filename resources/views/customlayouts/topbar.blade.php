<!-- Navbar -->

<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
        <a href="{{url('/dashboard')}}" class="navbar-brand" style="margin-left: -50px">
            <img src="{{asset("dist/img/IRLogo.png")}}" alt="Islamic Relief Logo"
                 class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-bold">IR - GSD |</span>
            <span class="brand-text font-weight-lighter">
                G<span style="font-size: medium">LOBAL</span> S<span style="font-size: medium">CREENING</span> D<span style="font-size: medium">ATABASE</span>
            </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                {{--<li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>--}}
                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        <i class="nav-icon fas fa-cogs"></i> Settings</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                        <li><a href="{{ url('/department_list') }}" class="dropdown-item">
                                <i class="far fa-building nav-icon"></i> Department
                            </a>
                        </li>
                        <li><a href="{{ url('/region_list') }}" class="dropdown-item">
                                <i class="far fa-map nav-icon"></i> Regions
                            </a>
                        </li>
                        <li><a href="{{ url('/field_offices') }}" class="dropdown-item">
                                <i class="far fa-address-book nav-icon"></i> Field Office
                            </a>
                        </li>
                        <li><a href="{{ url('/designation_list') }}" class="dropdown-item">
                                <i class="far fa-flag nav-icon"></i> Job Title
                            </a>
                        </li>
                        {{--<li><a href="{{ url('/user_list') }}" class="dropdown-item">
                                <i class="far fa-user nav-icon"></i> User
                            </a>
                        </li>--}}
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="{{ url('/user_list') }}" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                               class="dropdown-item dropdown-toggle"><i class="far fa-user nav-icon"></i> User
                            </a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-1" href="{{ url('/user_list') }}" class="dropdown-item">
                                        <i class="fas fa-user"></i> User Details</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{ url('/email_user_list') }}" class="dropdown-item">
                                        <i class="fas fa-mail-bulk"></i> Email Mgt</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{ url('/login_log_report') }}" class="dropdown-item">
                                        <i class="fas fa-file-contract"></i> Login Log Report</a>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->user_role_id == 4 || Auth::user()->user_role_id == 1)
                            <li><a href="{{ url('/log-viewer') }}" class="dropdown-item">
                                    <i class="far fa-file-archive nav-icon"></i> Logs
                                </a>
                            </li>
                            <li><a href="{{ url('/queue_list') }}" class="dropdown-item">
                                    <i class="fas fa-anchor"></i> Que Jobs
                                </a>
                            </li>
                        @endif

                        <!-- End Level two -->
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        <i class="nav-icon fas fa-search-plus"></i> Employee Screening
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ url('/missing_employee_list') }}" class="dropdown-item">
                                <i class="far fa-user-circle"></i> Missing Employee Screening Details
                            </a>
                        </li>
                        <li><a href="{{ url('/employee_list') }}" class="dropdown-item">
                                <i class="far fa-list-alt nav-icon"></i> Employee Screening Details
                            </a>
                        </li>
                        {{--<li><a href="{{ url('/screening_add') }}" class="dropdown-item">
                                <i class="far fa-edit nav-icon"></i> Add Screening
                            </a>
                        </li>--}}
                        <!-- End Level two -->
                    </ul>
                </li>

                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        <i class="nav-icon fas fa-wheelchair"></i> Help
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#modal-default-help" href="#">
                                <i class="fa fa-wheelchair"></i> Work Flow
                            </a>
                        </li>
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#modal-default-user-guide" href="#">
                                <i class="far fa-list-alt nav-icon"></i> User Guide
                            </a>
                        </li>
                                <!-- End Level two -->
                    </ul>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            {{--<form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>--}}
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
            {{--<li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>--}}
            <!-- Notifications Dropdown Menu -->
            {{--<li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>--}}


            {{--<li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{$yellow_count + $red_count}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">{{$yellow_count + $red_count}} Screenings</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i>
                        <span class="badge bg-warning">{{$yellow_count}}</span>
                         Screenings
                        <span class="float-right badge bg-yellow text-muted text-sm">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file-alt mr-2"></i>
                        <span class="badge bg-danger">{{$red_count}}</span>
                        Screenings
                        <span class="float-right badge bg-danger text-muted text-sm">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </a>
                </div>
            </li>--}}


            {{--<li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>--}}

            <li class="user user-menu" style="margin-right: -20px;">
                @if(Auth::user()->gender == 'Male')
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src={{asset("dist/img/avatar5.png")}} class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        <i class="right fas fa-angle-down"></i>
                    </a>
                @else
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src={{asset("dist/img/avatar2.png")}} class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        <i class="right fas fa-angle-down"></i>
                    </a>
                @endif

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{url('/change_password')}}" class="dropdown-item">
                        <i class="fas fa-passport mr-2"></i> Change password

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('/logout')}}" class="dropdown-item">
                        <i class="fas fa-power-off mr-2"></i> Logout

                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->
<div class="modal fade" id="modal-default-help">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <img src="dist/img/screening_status_flow.png" alt="Screening Status Flow"
                         style="width: 90%; height: 90%; margin-left: 30px">
                </div>
                <br>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{----      Modal      ----}}

<div class="modal fade" id="modal-default-user-guide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <a href="dist/img/GSD - User guide.docx" alt="User Guide">
                        <i class="fa fa-download"></i> Download User Guide
                    </a>
                </div>
                <br>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
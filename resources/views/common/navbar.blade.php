<!-- .navbar -->
<nav class="navbar navbar-static-top">
    <div class="container-fluid m-0">
        <a class="navbar-brand float-left" href="{{ url('/') }}">
            <h4>{{ config('app.name')}}</h4>
        </a>
        <div class="menu">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </span>
        </div>
        <div class="topnav dropdown-menu-right float-right">
            <div class="btn-group">
                <div class="notifications messages no-bg">
                    <a class="btn btn-sm" data-toggle="dropdown" id="notifications_section"> <i
                                class="fa fa-bell-o"></i>
                        <span class="badge badge-pill badge-danger notifications_badge_top">9</span>
                    </a>
                    <div class="dropdown-menu drop_box_align" role="menu" id="notifications_dropdown">
                        <div class="popover-title">You have 9 Notifications</div>
                        <div id="notifications">
                            <div class="data">
                                <div class="row">
                                    <div class="col-12 message-data">
                                        <i class="fa fa-clock-o"></i>
                                        <strong>Remo</strong>
                                        sent you an image
                                        <br>
                                        <small class="primary_txt">just now.</small>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="row">
                                    <div class="col-12 message-data">
                                        <i class="fa fa-clock-o"></i>
                                        <strong>clay</strong>
                                        business propasals
                                        <br>
                                        <small class="primary_txt">20min Back.</small>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="row">

                                    <div class="col-12 message-data">
                                        <i class="fa fa-clock-o"></i>
                                        <strong>John</strong>
                                        meeting at Ritz
                                        <br>
                                        <small class="primary_txt">2hrs Back.</small>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="row">
                                    <div class="col-12 message-data">
                                        <i class="fa fa-clock-o"></i>
                                        <strong>Luicy</strong>
                                        Request Invitation
                                        <br>
                                        <small class="primary_txt">Yesterday.</small>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popover-footer">
                            <a href="#" class="text-white">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <div class="user-settings no-bg">
                    <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                        <strong>{{ Auth::user()->name }}</strong>
                        <span class="fa fa-sort-down white_bg"></span>
                    </button>
                    <div class="dropdown-menu admire_admin">
                        <a class="dropdown-item title" href="#">
                            Eelistused</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>
                            Logi välja</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Kohaloleku kalender
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/datatables.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datepicker/css/bootstrap-datepicker.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.min.css')}}"/>
    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/attendances.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/calendar.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-street-view"></i>
                        @yield('title')
                    </h4>
                </div>
            </div>
        </div>
    </header>

    <div class="outer">
        <div class="inner bg-container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-block m-t-35">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>


@stop
@section('footer_scripts')
    <!--plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/locale/et.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pluginjs/calendarcustom.js')}}"></script>
    <!-- end of plugin scripts -->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/attendances.calendar_view.js')}}"></script>
    <!-- end of global scripts-->
@stop

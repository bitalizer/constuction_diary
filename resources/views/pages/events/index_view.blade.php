@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Sündmused
    @parent
@stop
{{-- page level styles --}}
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/chosen/css/chosen.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datetimepicker/css/jquery.datetimepicker.min.css')}}" />
@section('header_styles')
    <!-- end of global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/calendar.css')}}"/>
@stop

@section('content')
    <header class="head">
        <div class="main-bar row">
            <div class="col-sm-6">
                <h4 class="nav_top_align">
                    <i class="fa fa-calendar"></i>
                    @yield('title')
                </h4>
            </div>
        </div>
    </header>

    <div class="outer">
        <div class="inner bg-light lter bg-container cal_btn_hov">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-block m-t-35">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel1">
                                <i class="fa fa-plus"></i>
                                Loo sündmus
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" id="new-event" class="form-control" placeholder="Event">
                                <div class="input-group-btn">
                                    <button type="button"
                                            class="color-chooser-btn btn btn-default text-white dropdown-toggle"
                                            data-toggle="dropdown">
                                        Default
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu float-right cal_modal_type color-chooser">
                                        <li class="bg-primary text-center">
                                            Primary
                                        </li>
                                        <li class="bg-success text-center">
                                            Success
                                        </li>
                                        <li class="bg-info text-center">
                                            Info
                                        </li>
                                        <li class="bg-warning text-center">
                                            warning
                                        </li>
                                        <li class="bg-danger text-center">
                                            Danger
                                        </li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger float-right" data-dismiss="modal">
                                Sulge
                                <i class="fa fa-times"></i>
                            </button>
                            <button type="button" class="btn btn-success pull-left" id="add-new-event"
                                    data-dismiss="modal">
                                <i class="fa fa-plus"></i>
                                Lisa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>


    <!-- edit Modal -->
    <div class="modal fade" id="evt_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-plus"></i>
                        Muuda sündmus
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row m-t-25">
                        <div class="col-lg-2">
                            <label for="name" class="col-form-label">Pealkiri</label>
                        </div>
                        <div class="col-xl-10">
                            <div class="input-group">
                                <input type="text" name="name" id="event_title" class="form-control">
                                <div class="input-group-btn">
                                    <button type="button"
                                            class="btn btn-default text-white dropdown-toggle color-chooser-btn"
                                            data-toggle="dropdown"
                                            style="background-color: rgb(0, 17, 34); border-color: rgb(0, 17, 34);">värv
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu float-right cal_modal_type color-chooser">
                                        <li class="bg-primary text-center">
                                            Primary
                                        </li>
                                        <li class="bg-success text-center">
                                            Success
                                        </li>
                                        <li class="bg-info text-center">
                                            Info
                                        </li>
                                        <li class="bg-warning text-center">
                                            warning
                                        </li>
                                        <li class="bg-danger text-center">
                                            Danger
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row m-t-25">
                        <div class="col-lg-2">
                            <label for="name" class="col-form-label">Info</label>
                        </div>
                        <div class="col-xl-10">
                            <div class="input-group">
                                <textarea rows="2" id="event_information" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row m-t-25">
                        <div class="col-lg-2">
                            <label for="name" class="col-form-label">Töötajad</label>
                        </div>
                        <div class="col-xl-10">
                            <div class="input-group">
                                <select size="3" multiple class="form-control chzn-select"
                                        id="employee_select"
                                        name="employee_select" tabindex="8">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row m-t-25">
                        <div class="col-lg-2">
                            <label for="name" class="col-form-label">Algus</label>
                        </div>
                        <div class="col-xl-10">
                            <div class="input-group">
                                <input rows="2" id="event_start" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row m-t-25">
                        <div class="col-lg-2">
                            <label for="name" class="col-form-label">Lõpp</label>
                        </div>
                        <div class="col-xl-10">
                            <div class="input-group">
                                <input rows="2" id="event_end" class="form-control"/>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal">
                        Sulge
                        <i class="fa fa-times"></i>
                    </button>
                    <button type="button" class="btn btn-success pull-left text_save" data-dismiss="modal">
                        Uuenda
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- global scripts-->
@stop
<!-- global scripts-->
@section('footer_scripts')
    <!-- end of global scripts-->
    <!--plugin script-->
    <script type="text/javascript" src="{{asset('assets/vendors/chosen/js/chosen.jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/locale/et.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pluginjs/calendarcustom.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>
    <!-- end of plugin scripts -->
    <script type="text/javascript" src="{{asset('assets/js/pages/events.js')}}"></script>
@stop
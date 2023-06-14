@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Töötasu
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/datatables.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datepicker/css/bootstrap-datepicker.min.css')}}"/>
    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/accounting.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-book"></i>
                        @yield('title')
                    </h4>
                </div>
            </div>
        </div>
    </header>

    <div class="outer">
        <div class="inner bg-container">

            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="bg-primary top_cards">
                                <div class="row icon_margin_left">

                                    <div class="col-5 icon_padd_left">
                                        <div class="float-left">
<span class="fa-stack fa-sm">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-euro fa-stack-1x fa-inverse text-primary sales_hover"></i>
</span>
                                        </div>
                                    </div>
                                    <div class="col-7 icon_padd_right">
                                        <div class="cards_content">
                                            <span class="number_val" id="sales_count">{{ $wage_fund }}€</span>
                                            <br>
                                            <span class="card_description">Palgafond</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="bg-success top_cards">
                                <div class="row icon_margin_left">
                                    <div class="col-5 icon_padd_left">
                                        <div class="float-left">
<span class="fa-stack fa-sm">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-hourglass fa-stack-1x fa-inverse text-success visit_icon"></i>
</span>
                                        </div>
                                    </div>
                                    <div class="col-7 icon_padd_right">
                                        <div class="cards_content">
                                            <span class="number_val" id="visitors_count">{{ $hours_sum }}</span>
                                            <br>
                                            <span class="card_description">Tunde</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="bg-warning top_cards">
                                <div class="row icon_margin_left">
                                    <div class="col-5 icon_padd_left">
                                        <div class="float-left">
<span class="fa-stack fa-sm">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa fa-street-view fa-stack-1x fa-inverse text-warning revenue_icon"></i>
</span>
                                        </div>
                                    </div>
                                    <div class="col-7 icon_padd_right">
                                        <div class="cards_content">
                                            <span class="number_val" id="revenue_count">{{ $attendance_sum }}</span>
                                            <br>
                                            <span class="card_description">Kohalolekuid</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="bg-mint top_cards">
                                <div class="row icon_margin_left">
                                    <div class="col-5 icon_padd_left">
                                        <div class="float-left">
<span class="fa-stack fa-sm">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-users  fa-stack-1x fa-inverse text-mint sub"></i>
</span>
                                        </div>
                                    </div>
                                    <div class="col-7 icon_padd_right">
                                        <div class="cards_content">
                                            <span class="number_val" id="subscribers_count">{{ $employee_count }}</span>
                                            <br>
                                            <span class="card_description">Töötajaid</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-12 stat_align">

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card m-t-35">
                        <div class="card-header bg-white">
                            Töötasu nimekiri
                        </div>
                        <div class="card-block m-t-35" id="user_body">
                            <div>
                                <div>
                                    <form method="POST">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <!-- Name input-->
                                            <div class="form-group row form_inline_inputs_bot">


                                                <div class="col-sm-3">
                                                    <label for="from_date" class="col-form-label form-group-horizontal">
                                                        Alates
                                                    </label>
                                                    <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-calendar-minus-o"></i>
                                                        </span>
                                                        <input type="text" class="form-control datepicker"
                                                               value="{{ date('d.m.Y', strtotime($filters->from_date)) }}" name="from_date"
                                                               readonly="true">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <label for="to_date" class="col-form-label form-group-horizontal">
                                                        Kuni
                                                    </label>
                                                    <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-calendar-plus-o"></i>
                                                        </span>
                                                        <input type="text" class="form-control datepicker"
                                                               value="{{ date('d.m.Y', strtotime($filters->to_date)) }}" name="to_date"
                                                               readonly="true">
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 m-t-35">
                                                    <div class="btn-group">
                                                        <button type="submit"
                                                                class="btn btn-primary layout_btn_prevent btn-responsive form_inline_btn_margin-top">
                                                            Filtreeri
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-warning layout_btn_prevent btn-responsive form_inline_btn_margin-top clear">
                                                            Tühista
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>


                                    <table id="example"
                                           class="table table-striped table-bordered table-hover dataTable no-footer"
                                           role="grid">
                                        <thead>
                                        <tr>
                                            <th>Töötaja</th>
                                            <th>Amet</th>
                                            <th>Tavalisi tunde</th>
                                            <th>Nädalavahetus tunde</th>
                                            <th>Puhkepäeva tunde</th>
                                            <th>Öövahetuse tunde</th>
                                            <th>Tunde kokku</th>
                                            <th>Kohalolekuid</th>
                                            <th>Kogu palk</th>
                                            <th>Tegevus</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($payrolls as $payroll)
                                            <tr>
                                                <td>{{ $payroll->employee_name }}</td>
                                                <td>{{ $payroll->position_name }}</td>
                                                <td>{{ $payroll->usual_hours }}</td>
                                                <td>{{ $payroll->weekend_hours }}</td>
                                                <td>{{ $payroll->holiday_hours }}</td>
                                                <td>{{ $payroll->night_shift_hours }}</td>
                                                <td>{{ $payroll->total_hours }}</td>
                                                <td>{{ $payroll->total_attendances }}</td>
                                                <td>{{ $payroll->total_salary }}€</td>
                                                <td>
                                                    <a class="edit" data-toggle="tooltip" data-placement="top"
                                                       title="Vaata kohalolekud"
                                                       href="{{ URL::to('attendances/table/' . $payroll->employee_id) }}"><i
                                                                class="fa fa-street-view text-success"></i>
                                                    </a>
                                                    <a class="edit" data-toggle="tooltip" data-placement="top"
                                                       title="Muuda tariifid"
                                                       href="{{ URL::to('employees/' . $payroll->employee_id) }}"><i
                                                                class="fa fa-pencil text-warning"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>


@stop
@section('footer_scripts')
    <!--plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.colVis.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- end of plugin scripts -->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/accounting.payroll_view.js')}}"></script>
    <!-- end of global scripts-->
@stop

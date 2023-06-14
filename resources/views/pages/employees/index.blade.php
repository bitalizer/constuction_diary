@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Töötajad
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
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/employees.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-users"></i>
                        @yield('title')
                    </h4>
                </div>
            </div>
        </div>
    </header>

    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Töötajate nimekiri @if($canManage)<a class="btn btn-primary btn-md adv_cust_mod_btn pull-right" data-toggle="modal"
                                          data-href="#add_employee_modal" href="#add_employee_modal">Lisa töötaja</a>@endif
                </div>
                <div class="card-block">
                    <div class="form-group row">

                        <div class="col-lg-12">
                            <div>
                                <div>
                                    <table id="example"
                                           class="table table-striped table-bordered table-hover dataTable no-footer"
                                           role="grid">
                                        <thead>
                                        <tr>
                                            <th>Nr.</th>
                                            <th>Täisnimi</th>
                                            <th>Amet</th>
                                            <th>Telefon</th>
                                            <th>Tegevus</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($employees as $employee)
                                            <tr class="{{ $employee->trashed() ? 'archived' : '' }}" data-id="{{ $employee->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->position->display_name }}</td>
                                                <td>{{ $employee->phone_number !== null ? $employee->phone_number : '-' }}</td>
                                                <td>
                                                    <a href="{{ URL::to('employees/' . $employee->id) }}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="Vaata"><i class="fa fa-eye text-success"></i></a>
                                                    @if($canManage)
                                                    &nbsp;<a class="edit" data-toggle="tooltip" data-placement="top"
                                                             title="Muuda" href="#">
                                                        <i class="fa fa-pencil text-warning"></i>
                                                    </a>&nbsp;
                                                    &nbsp;<a class="archive hidden-xs hidden-sm" data-toggle="tooltip"
                                                             data-placement="top" title="{{ $employee->trashed() ? 'Taasta' :  'Arhiveeri'}}" href="#"><i
                                                                    class="fa {{ $employee->trashed() ? 'fa-refresh text-info' :  'fa-trash text-danger'}}"></i>
                                                        </a>
                                                    @endif
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
            @include('pages.employees.add_modal')
            @include('pages.employees.edit_modal')
        </div>
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

    <script type="text/javascript" src="{{asset('assets/js/pages/employees.index.js')}}"></script>
@stop

@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Positsioonid
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/datatables.css')}}"/>
    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/positions.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-calendar"></i>
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
                    Positsioonide nimekiri @if($canManage)<a class="btn btn-primary btn-md adv_cust_mod_btn pull-right" href="{{ URL::to('positions/add') }}">Lisa positsioon</a>@endif
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
                                            <th>Nimi</th>
                                            <th>Kuvamise nimi</th>
                                            <th>Kirjeldus</th>
                                            <th>Loomise kuupäev</th>
                                            <th>Uuendamise kuupäev</th>
                                            @if($canManage)<th>Tegevused</th>@endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($positions as $position)
                                            <tr data-id="{{ $position->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $position->name }}</td>
                                                <td>{{ $position->display_name }}</td>
                                                <td>{{ $position->description }}</td>
                                                <td>{{ date('d.m.Y', strtotime($position->created_at)) }}</td>
                                                <td>{{ date('d.m.Y', strtotime($position->updated_at)) }}</td>
                                            @if($canManage)
                                                <td>
                                                    &nbsp;<a class="edit" data-toggle="tooltip" data-placement="top"
                                                             title="Muuda"
                                                             href="{{ URL::to('positions/' . $position->id) }}"><i class="fa fa-edit text-success"></i>
                                                    </a>&nbsp;
                                                    &nbsp;<a class="delete hidden-xs hidden-sm" data-toggle="tooltip"
                                                             data-placement="top" title="Kustuta" href="#"><i
                                                                class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                                @endif
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

    <script type="text/javascript" src="{{asset('assets/js/pages/positions.index.js')}}"></script>
@stop
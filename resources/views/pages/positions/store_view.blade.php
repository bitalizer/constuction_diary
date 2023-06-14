@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ $position ? 'Positsiooni muutmine' : 'Positsiooni lisamine' }}
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')

    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/chosen/css/chosen.css')}}"/>
    <!-- end of plugin styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/positions.css')}}">
    <!--End of page level styles-->
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="card m-t-35">
                        <div class="card-header bg-white">
                            Põhilised andmed
                        </div>
                        <div class="card-block">
                            <form class="form-horizontal">
                                <fieldset>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="name" class="col-form-label form-group-horizontal">
                                                Nimetus
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       value="{{ $position ? $position->name : '' }}" id="name"
                                                       placeholder="Sisestage nimetus" {{ $position ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="display_name" class="col-form-label form-group-horizontal">
                                                Kuvatav nimi
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       value="{{ $position ? $position->display_name : '' }}"
                                                       id="display_name" placeholder="Sisestage kuvatav nimi">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="description" class="col-form-label form-group-horizontal">
                                                Kirjeldus
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       value="{{ $position ? $position->description : '' }}"
                                                       id="description" placeholder="Sisestage kirjeldus">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card m-t-35">
                                <div class="card-header bg-white">
                                    Õigused
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">


                                        <table id="example"
                                               class="table table-striped table-bordered table-hover dataTable no-footer"
                                               role="grid">
                                            <thead>
                                            <tr>
                                                <th>Nimetus</th>
                                                <th>Kirjeldus</th>
                                                <th>Kontroller</th>
                                                <th>Ligipääs</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($permissions as $permission)
                                                <tr data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                                                    <td>{{ $permission->display_name }}</td>
                                                    <td>{{ $permission->description }}</td>
                                                    <td>{{ $permission->controller }}</td>
                                                    <td><input type="checkbox" {{ $position && $position->hasPermission($permission->name) ? 'checked' : '' }}></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 text-right">
                        <button type="button" id="submit" class="btn button-alignment btn-success m-t-15"
                                data-toggle="button">
                            {{ $position ? 'Muuda' : 'Lisa' }} positsioon
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('footer_scripts')
        <!--  plugin scripts -->
            <script type="text/javascript" src="{{asset('assets/vendors/chosen/js/chosen.jquery.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/dataTables.responsive.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/dataTables.buttons.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/buttons.colVis.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/buttons.html5.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/buttons.bootstrap.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datatables/js/buttons.print.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('assets/vendors/clockpicker/js/jquery-clockpicker.min.js')}}"></script>
            <!--end of plugin scripts-->
            <script type="text/javascript" src="{{asset('assets/js/pages/positions.store_view.js')}}"></script>
@stop

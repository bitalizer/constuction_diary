@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Seaded
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/datatables.css')}}"/>
    <link type="text/css" rel="stylesheet"
          href="{{asset('assets/vendors/datepicker/css/bootstrap-datepicker.min.css')}}"/>
    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/settings.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-cogs"></i>
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
                        <div class="card-header bg-white">
                            Üldised seaded
                        </div>
                        <div class="card-block">
                            <form class="form-horizontal">
                                <fieldset>

                                    <div class="input-group variables">

                                        <div class="col-sm-6">
                                            <label for="company" class="col-form-label form-group-horizontal">
                                                Ehitusettevõtja
                                            </label>
                                            <div class="input-group">
                                                <input type="text" data-name="company"
                                                       class="form-control"
                                                       value="{{ $variables['company'] }}"
                                                       placeholder="Sisestage objekti ehitusettevõtja">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-12 col-sm-12 text-right">
                                        <button type="button" id="submit"
                                                class="btn button-alignment btn-success m-t-15" data-toggle="button">
                                            Salvesta
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
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
    <!-- end of plugin scripts -->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/settings.general_view.js')}}"></script>
    <!-- end of global scripts-->
@stop

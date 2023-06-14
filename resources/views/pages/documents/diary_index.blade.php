@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Dokumendid
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
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/documents.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-paperclip"></i>
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
                    <div class="card m-t-35">
                        <div class="card-header bg-white">
                            Päevikute nimekiri
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
                                                        <input type="text" class="form-control datepicker" value="{{ $filters->from_date }}" name="from_date" readonly="true">
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
                                                        <input type="text" class="form-control datepicker" value="{{ $filters->to_date }}" name="to_date" readonly="true">
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 m-t-35">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-primary layout_btn_prevent btn-responsive form_inline_btn_margin-top">Filtreeri</button>
                                                        <button type="button" class="btn btn-warning layout_btn_prevent btn-responsive form_inline_btn_margin-top clear">Tühista</button>
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
                                            <th>Nr.</th>
                                            <th>Kuupäev</th>
                                            <th>Objekt</th>
                                            <th>Töö kirjeldus</th>
                                            <th>Töödejuht</th>
                                            <th>Tegevus</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($diaries as $diary)
                                            <tr data-id="{{ $diary->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td data-order="{{ date('Y-m-d', strtotime($diary->date)) }}">{{ date('d.m.Y', strtotime($diary->date)) }}</td>
                                                <td>{{ $diary->project->name }}</td>
                                                <td>{{ $diary->work_description }}</td>
                                                <td>{{ $diary->submitter->name }}</td>
                                                <td>
                                                    <a href="{{ URL::to('documents/diary/' . $diary->id) }}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="Vaata"><i class="fa fa-eye text-success"></i>
                                                    </a>
                                                    <a href="{{ URL::to('documents/diary/' . $diary->id) }}/download"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="PDF"><i class="fa fa-file-pdf-o text-info"></i>
                                                    </a>
                                                    @if($canManage)
                                                        <a class="edit" data-toggle="tooltip" data-placement="top"
                                                                title="Muuda"
                                                                href="{{ URL::to('documents/diary/' . $diary->id) }}"><i
                                                                    class="fa fa-pencil text-warning"></i>
                                                        </a>
                                                        <a class="delete hidden-xs hidden-sm" data-toggle="tooltip"
                                                           data-placement="top" title="Kustuta" href="#"><i
                                                                    class="fa fa-trash text-danger"></i>
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
    <script type="text/javascript" src="{{asset('assets/js/pages/documents.diary_index.js')}}"></script>
    <!-- end of global scripts-->
@stop

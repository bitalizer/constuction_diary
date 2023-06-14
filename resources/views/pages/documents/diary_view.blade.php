@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Päevik #{{ $diary->id }}
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')

    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/chosen/css/chosen.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/datepicker/css/bootstrap-datepicker.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/clockpicker/css/jquery-clockpicker.css')}}"/>
    <!-- end of plugin styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/documents.css')}}">
    <!--End of page level styles-->
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
                                            <label for="mechanisms" class="col-form-label form-group-horizontal">
                                                Objekt
                                            </label>
                                            <div class="input-group">
                                                <select size="3" class="form-control chzn-select"
                                                        id="object_select" tabindex="8" data-placeholder="Tehke valik">
                                                    @foreach($projects as $project)
                                                        <option value="{{ $project->id }}" {{ $diary->project_id === $project->id ? 'selected' : '' }}>{{ $project->name }}
                                                            , {{ $project->location }} {{ $project->trashed() ? '(Arhiveeritud)' : '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="mechanisms" class="col-form-label form-group-horizontal">
                                                Mehhanismid objektil
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="mechanisms" rows="2"
                                                          placeholder="Kirjeldus">{{ $diary->mechanisms }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="work_description" class="col-form-label form-group-horizontal">
                                                Tehtavad tööd, olukord objektil
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="work_description" rows="2"
                                                          placeholder="Kirjeldus">{{ $diary->work_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="comments" class="col-form-label form-group-horizontal">
                                                Muud märkused ja asjaolud
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="comments" rows="2"
                                                          placeholder="(saadud ja antud juhised,ilmastiku-tingimuste ja segavate asjaolude mõju, load, side ametiasutustega jm.)">{{ $diary->comments }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row m-t-25">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="equipment" class="col-form-label form-group-horizontal">
                                                Tellitud materjalid, seadmed, joonised
                                            </label>
                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-wrench"></i>
                                                        </span>
                                                <input type="text" class="form-control" id="equipment"
                                                       value="{{ $diary->equipment }}"
                                                       placeholder="Sisestage materjalid/seadmed/joonised">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="date" class="col-form-label orm-group-horizontal">
                                                Kuupäev
                                            </label>
                                            <div class="input-group input-append date" data-date-format="dd-mm-yyyy">
                                                 <span class="input-group-addon add-on">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date"
                                                       class="form-control datepicker"
                                                       type="text"
                                                       value="{{ date('d.m.Y', strtotime($diary->date)) }}"
                                                       placeholder="dd.mm.yyyy"
                                                       readonly="true">

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>

                    <div class="card m-t-35">
                        <div class="card-header bg-white">
                            Muud andmed
                        </div>
                        <div class="card-block">
                            <form class="form-horizontal">
                                <fieldset>
                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="signup_email" class="col-form-label form-group-horizontal">
                                                Kontroll ametiisikud, proj.-rija, muud
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="control"
                                                          rows="1">{{ $diary->control }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="signup_email" class="col-form-label form-group-horizontal">
                                                Ametnike, tellija ja järelvalve juhised
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="instructions"
                                                          rows="1">{{ $diary->instructions }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-10 push-lg-1">
                                            <label for="acts_and_documents"
                                                   class="col-form-label form-group-horizontal">
                                                Koostatud aktid ja dokumendid
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="acts_and_documents"
                                                          rows="1">{{ $diary->acts_and_documents }}</textarea>
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
                                    Tööjõud <a class="btn btn-primary btn-md adv_cust_mod_btn pull-right"
                                               data-toggle="modal"
                                               data-href="#responsive" href="#responsive">Lisa töötaja</a>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">

                                        <div class="col-lg-12">
                                            <div id="workers-table" class="table-editable table-hover no-footer">

                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Nimi</th>
                                                        <th>Töö algus</th>
                                                        <th>Töö lõpp</th>
                                                        <th>Tunnid</th>
                                                        <th>Märge</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($diary->employees as $employee)
                                                        <tr data-id="{{ $employee->id }}">
                                                            <td>{{ $employee->name }}<span class="table-remove fa fa-remove"></span></td>
                                                            <td>{{ date('H:i', strtotime($employee->pivot->start_time)) }}</td>
                                                            <td>{{ date('H:i', strtotime($employee->pivot->end_time)) }}</td>
                                                            <td contenteditable="true">{{ $employee->pivot->hours }}</td>
                                                            <td contenteditable="true">{{ $employee->pivot->note }}</td>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card m-t-35">
                                <div class="card-header bg-white">
                                    Ilmastik
                                </div>
                                <div class="card-block">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <!-- Name input-->
                                            <div class="form-group row m-t-25">
                                                <div class="col-lg-10 push-lg-1">
                                                    <label for="weather_time"
                                                           class="col-form-label form-group-horizontal">
                                                        Kellaaeg
                                                    </label>
                                                    <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                        <input type="text" class="form-control clockpicker"
                                                               id="weather_time"
                                                               value="{{ date('H:i', strtotime($diary->weather_time)) }}"
                                                               placeholder="tt:mm"
                                                               readonly="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- first name-->
                                            <div class="form-group row">
                                                <div class="col-lg-10 push-lg-1">
                                                    <label for="signup_email"
                                                           class="col-form-label form-group-horizontal">
                                                        Temperatuur
                                                    </label>
                                                    <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-cloud"></i>
                                                        </span>
                                                        <input class="form-control" id="weather_temperature"
                                                               value="{{ $diary->weather_temperature }}" type="number"
                                                               name="spinner" placeholder="6">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-10 push-lg-1">
                                                    <label for="signup_password"
                                                           class="col-form-label form-group-horizontal">
                                                        Ilm
                                                    </label>
                                                    <div class="input-group">
                                                        <select size="3" multiple class="form-control chzn-select"
                                                                id="weather_select"
                                                                name="weather_select" tabindex="8">
                                                            <option {{ $diary->weather_wind ? 'selected' : '' }}>Tugev
                                                                tuul
                                                            </option>
                                                            <option {{ $diary->weather_dry ? 'selected' : '' }}>Kuiv
                                                            </option>
                                                            <option {{ $diary->weather_rain ? 'selected' : '' }}>Vihm
                                                            </option>
                                                            <option {{ $diary->weather_sleet ? 'selected' : '' }}>
                                                                Lörts
                                                            </option>
                                                            <option {{ $diary->weather_snow ? 'selected' : '' }}>Lumi
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 text-right">
                <button type="button" id="submit" class="btn button-alignment btn-success m-t-15" data-toggle="button">
                    Salvesta
                </button>
                <a href="/documents/diary/{{ $diary->id }}/download" class="btn button-alignment btn-info m-t-15">
                    PDF
                </a>
            </div>
        </div>
        @include('pages.documents.diary_add_worker_modal')
    </div>
    </div>
@stop
@section('footer_scripts')
    <!--  plugin scripts -->
    <script type="text/javascript" src="{{asset('assets/vendors/chosen/js/chosen.jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/clockpicker/js/jquery-clockpicker.min.js')}}"></script>
    <!--end of plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/documents.diary_view.js')}}"></script>
@stop
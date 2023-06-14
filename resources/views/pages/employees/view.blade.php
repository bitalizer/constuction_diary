@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Töötajad
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet"
          href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
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
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-6 m-t-35">
                            <div class="text-center">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumb_zoom zoom admin_img_width">
                                            <img src="/uploads/avatars/{{ $employee->avatar}}" alt="admin"
                                                 class="admin_img_width"></div>
                                        <div class="fileinput-preview fileinput-exists thumb_zoom zoom admin_img_width"></div>
                                        <div class="btn_file_position">
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">Muuda pilti</span>
                                                        <span class="fileinput-exists">Muuda</span>
                                                        <input type="file" name="Changefile">
                                                    </span>
                                            <a href="#" class="btn btn-warning fileinput-exists"
                                               data-dismiss="fileinput">Kustuta</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 m-t-25">
                            <div>
                                <ul class="nav nav-inline view_user_nav_padding">
                                    <li class="nav-item card_nav_hover">
                                        <a class="nav-link active" href="#user" id="home-tab" data-toggle="tab"
                                           aria-expanded="true">Töötaja ülevaade</a>
                                    </li>
                                </ul>
                                <div id="clothing-nav-content" class="tab-content m-t-10">
                                    <div role="tabpanel" class="tab-pane fade show active" id="user">
                                        <table class="table" id="users">
                                            <tbody>
                                            <tr>
                                                <td>Täisnimi</td>
                                                <td class="inline_edit">
                                                    <span>{{ $employee->name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>E-mail</td>
                                                <td>
                                                    <span>{{ $employee->email }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Telefon</td>
                                                <td>
                                                    <span>{{ $employee->phone_number }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Positsioon</td>
                                                <td>
                                                    <span>{{ $employee->position->display_name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Viimane kohaloleku kuupäev</td>
                                                <td>
                                                    <span>{{  date('d.m.Y', strtotime($last_working_day)) }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Töölevõtukuupäev</td>
                                                <td>
                                                    <span>{{  date('d.m.Y', strtotime($employee->hire_date)) }}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @permission('manage-accounting')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card m-t-35">
                        <div class="card-header bg-white">
                            Objektid
                        </div>
                        <div class="card-block">
                            <div class="form-group row">

                                <div class="col-lg-12">
                                    <div id="workers-table" class="table-editable table-hover no-footer">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Objekt</th>
                                                <th>Asukoht</th>
                                                <th>Tunnitöö tariif (€)</th>
                                                <th>Nädalavahetused makstavad</th>
                                                <th>Pühad makstavad</th>
                                                <th>Öövahetused makstavad</th>
                                                <th>Viimati uuendatud</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($projects_salary as $project_salary)
                                                <tr data-project-id="{{ $project_salary->id }}">
                                                    <td>{{ $project_salary->name }}</td>
                                                    <td>{{ $project_salary->location }}</td>

                                                    <td>
                                                        <input class="form-control" type="number" id="hourly_rate"
                                                               placeholder="0.00" min="0" max="200" step="0.5" value="{{ $project_salary->hourly_rate }}"
                                                               pattern="^\d+(?:\.\d{1,1})?$">
                                                    </td>

                                                    <td>
                                                        <select class="form-control" size="1" id="weekend_payable">
                                                            <option value="true" {{ $project_salary->weekend_payable ? 'selected="selected"' : ""}}>
                                                                Jah
                                                            </option>
                                                            <option value="false" {{ $project_salary->weekend_payable ? "" : 'selected="selected"'}}>
                                                                Ei
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select class="form-control" size="1" id="holiday_payable">
                                                            <option value="true" {{ $project_salary->holiday_payable ? 'selected="selected"' : ""}}>
                                                                Jah
                                                            </option>
                                                            <option value="false" {{ $project_salary->holiday_payable ? "" : 'selected="selected"'}}>
                                                                Ei
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select class="form-control" size="1" id="night_shift_payable">
                                                            <option value="true" {{ $project_salary->night_shift_payable ? 'selected="selected"' : ""}}>
                                                                Jah
                                                            </option>
                                                            <option value="false" {{ $project_salary->night_shift_payable ? "" : 'selected="selected"'}}>
                                                                Ei
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <td>{{ $project_salary->updated_at }}</td>
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
            @endpermission
        </div>
    </div>
@stop
@section('footer_scripts')
    <!--plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <!-- end of plugin scripts -->

    <script type="text/javascript" src="{{asset('assets/js/pages/employees.view.js')}}"></script>
@stop

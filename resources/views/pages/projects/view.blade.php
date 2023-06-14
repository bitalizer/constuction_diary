@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Objektid
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugincss/dataTables.bootstrap.css')}}"/>
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/projects.css')}}"/>
    <!-- end of page level styles -->
@stop
@section('content')

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-briefcase"></i>
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
                        <div class="col-lg-6 m-t-25">
                            <div>
                                <ul class="nav nav-inline view_user_nav_padding">
                                    <li class="nav-item card_nav_hover">
                                        <a class="nav-link active" href="#user" id="home-tab" data-toggle="tab"
                                           aria-expanded="true">Objekti ülevaade</a>
                                    </li>
                                </ul>
                                <div id="clothing-nav-content" class="tab-content m-t-10">
                                    <div role="tabpanel" class="tab-pane fade show active" id="user">
                                        <table class="table" id="users">
                                            <tbody>
                                            <tr>
                                                <td>Nimetus</td>
                                                <td class="inline_edit">
                                                    <span>{{ $project->name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Asukoht</td>
                                                <td>
                                                    <span>{{ $project->location }}</span>
                                                </td>
                                            </tr>
                                            @if($project->trashed())
                                                <tr>
                                                    <td>Arhiveerimise kuupäev</td>
                                                    <td>
                                                        <span>{{  date("d.m.Y", strtotime($project->deleted_at)) }}</span>
                                                    </td>
                                                </tr>
                                            @endif
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
    </div>
@stop
@section('footer_scripts')
    <!--plugin scripts-->
    <!-- end of plugin scripts -->
    <script type="text/javascript" src="{{asset('assets/js/pages/projects.view.js')}}"></script>
@stop

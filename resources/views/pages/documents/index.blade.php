@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Dokumendid
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/documents.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/chosen/css/chosen.css')}}"/>
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
                <div class="col-md-4">
                    <div class="square-service-block">
                        <a href="{{ URL::to('documents/diary') }}">
                            <div class="ssb-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                            <h2 class="ssb-title">Päevikute nimekiri</h2>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="square-service-block">
                        <a href="{{ URL::to('documents/act') }}">
                            <div class="ssb-icon"> <i class="fa fa-paste" aria-hidden="true"></i> </div>
                            <h2 class="ssb-title">Kaetud tööde aktid</h2>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="square-service-block">
                        <a href="{{ URL::to('documents/protocol') }}">
                            <div class="ssb-icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i></div>
                            <h2 class="ssb-title">Töökoosolekute protokollid</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
@stop

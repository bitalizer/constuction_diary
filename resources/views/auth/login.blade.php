@extends('layouts/auth')

{{-- Page title --}}
@section('title')
    Autoriseerimine
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/login.css')}}">
    <!--End of page level styles-->
@stop
@section('content')
    <div class="login-box">
        <div class="login-box-body">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300" style="margin: 0px;"><i
                            class="fa fa-user-secret" style="font-size:22px"></i></div>
                <br>
                <h5 class="content-group">Logi sisse oma kontosse</h5>
            </div>

            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="" required name="email"/>
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="" required name="password"/>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-login btn-block">Sisene <i class="fa fa-arrow-right "></i></button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('footer_scripts')

    @if ($errors->has('email') || $errors->has('password'))
    <script>
        swal({
            type: 'warning',
            title: 'Oih!',
            text: 'Andmed ei vasta õigetele',
            timer: 3000,
            onOpen: () => {
                swal.showLoading()
            }
        });
    </script>
    @endif

    <!--end of plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/login.js')}}"></script>
@stop
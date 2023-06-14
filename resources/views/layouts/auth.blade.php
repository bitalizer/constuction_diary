<!doctype html>
<html class="no-js" lang="en">

@include('common.head')

{{-- Page title --}}

@section('title')
    Autoriseerimine
    @parent
@stop

<body class="login-page">
@yield('content')
</body>

<!-- global scripts-->
<script type="text/javascript" src="{{asset('assets/js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>
<!doctype html>
<html class="no-js" lang="en">

@include('common.head')

<body class="fixedMenu_left">
@include('common.preloader')
<div class="bg-dark" id="wrap">
    <div id="top">
    @section('navbar')
        @include('common.navbar')
    @show
    <!-- /.head -->
    </div>
    <!-- /#top -->
    <div class="wrapper">
        @section('menu')
            @include('common.menu')
        @show
        <div id="content" class="bg-container">
            <!-- Content -->
        @yield('content')
        <!-- Content end -->
        </div>
    </div>
    <!-- /#content -->
</div>
<!-- /#wrap -->
<!-- global scripts-->
<script type="text/javascript" src="{{asset('assets/js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BLOG</title>
    @yield('head')
    @include('Admin.common.header')
    @yield('before.css')
</head>

<body class="gray-bg">
<div id="wrapper" style="height: 100%;">
    @include('Admin.common.menu')

    <div id="page-wrapper" class="gray-bg" style="height:inherit;">
        {{--<div class="row border-bottom">--}}
            {{--<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">--}}
                {{--<div class="navbar-header">--}}
                    {{--<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="chat_view.html#"><i class="fa fa-bars"></i> </a>--}}
                    {{--<form role="search" class="navbar-form-custom" action="search_results.html">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</nav>--}}
        {{--</div>--}}

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2></h2>
                <ol class="breadcrumb">
                    <li class="">
                        <a href="{{asset('/Kawhi')}}" class="nav-label"></a>
                    </li>
                    <li class="">
                        <a class="second-label"></a>
                    </li>
                    <li class="">
                        <strong class="third-label"></strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/plugins/layer/layer.min.js"></script>
<script src="/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/js/jquery.pjax.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(jqXHR, textStatus, errorThrown){
                if(jqXHR.status >= 500){
                    var msg = '服务器错误';
                }else if(jqXHR.status >= 400){
                    var msg = '路由错误或无权限';
                }else{
                    var msg = '未知错误';
                }

                layer.alert(msg, {
                    icon: 1
                }, function () {
                    location.reload();
                });
            }
        });
    });

</script>
@yield('after.js')

@include('Admin.common.footer')
@yield('foot')

</body>
</html>
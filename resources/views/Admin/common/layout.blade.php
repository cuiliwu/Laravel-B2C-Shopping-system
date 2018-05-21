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
    <title>INSPINIA | Dashboard</title>
    @yield('head')
    @yield('before.css')

    @include('Admin.common.header')
</head>
{{--@include('Admin.common.menu')--}}

<div id="wrapper">
@include('Admin.common.menu')
@yield('content')
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
<body class="gray-bg">

@include('Admin.common.footer')
@yield('foot')

</body>
</html>
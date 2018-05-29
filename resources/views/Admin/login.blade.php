<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>INSPINIA | Login</title>

        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
    </head>
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">CUI+</h1>
                </div>
                <h3>Welcome to CUI+</h3>
                <p>

                </p>
                <form method="post" id="Form" action="{{ route('admin.dologin') }}">
                    {!! csrf_field() !!}
                    @foreach($errors->all() as $key=>$error)
                        <p class="jm_error fl text-danger">{{ $error }}</p>
                    @endforeach
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Username" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="required" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                </form>
                <a href="login.html#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script>
            {{--$("Form").submit(function(e){--}}
                {{--e.preventDefault();--}}
                {{--var data = $("Form").serialize();--}}
                {{--console.log(data);--}}
                {{--$.ajax({--}}
                    {{--url: '{{ route('admin.dologin') }}',--}}
                    {{--type: 'post',--}}
                    {{--dataType: 'json',--}}
                    {{--success: function (data) {--}}
                        {{--console.log(data);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        </script>
    </body>
</html>

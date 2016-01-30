<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DokterNet | PT. Nusantara Labs</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('partials.head')
    </head>
    <body class="hold-transition login-page">
        
            <div class="login-box">
                <div class="login-logo">
                    <a href="{!! route('admin.login') !!}"><b>Administrator</b>Panel</a>
                </div><!-- /.login-logo -->
                <div class="login-box-body">
                    @yield('content')
                </div><!-- /.login-box-body -->
            </div><!-- /.login-box -->
          
        <!-- add new calendar event modal -->
        @include('partials.footer')
    </body>
</html>
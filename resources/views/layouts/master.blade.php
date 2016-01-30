<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DokterNet | PT. Nusantara Labs</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('partials.head')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('partials.main-container')
        
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                @include('partials.sidebar')
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                @yield('content')
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->    
        <!-- add new calendar event modal -->
        @include('partials.footer')
    </body>
</html>
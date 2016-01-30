<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DokterNet</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('frontend.partials.head')
    </head>
    <body>
        @include('frontend.partials.main-container')
        <section>
            @yield('content')
        </section>
        @include('frontend.partials.footer')
    </body>
</html>
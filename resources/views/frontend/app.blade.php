<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DokterNet</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('frontend.partials.head')
    </head>
    <body>
        <div class="container main-page">
            <div class="row main-page-content">
                @include('frontend.partials.main-container')
                <section>
                    <div class="container">
                        @yield('content')
                    </div>
                </section>
                <div class="col-md-12">
                    @include('frontend.partials.footer')
                </div>
            </div>
        </div>
    </body>
</html>
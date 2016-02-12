@extends( 'frontend.app' )

@section( 'content' )
  <div class="row" style="margin-top: 30px; margin-bottom: 30px">
    <div class="col-md-3">
      @include('frontend.pages.clinic.sidebar')
    </div>
    <div class="col-md-9">
      @include( 'frontend.errors.session' )
      @yield( 'sub-content' )
    </div>
  </div>
@endsection

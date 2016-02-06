@extends( 'frontend.app' )

@section( 'content' )
  <div class="container">
    <div class="row" style="margin-top: 30px">
      <div class="col-xs-12 col-md-6 col-md-offset-6">
        <div class="panel panel-info" style="padding: 20px 30px 30px">
          <h2>Login Klinik</h2>
          <hr>
          @include( 'frontend.errors.session' )
          {!! BootForm::open()->action( route( 'clinic.login.post' ) ) !!}
          <div class="box-body">
            {!! BootstrapForm::text( 'email', 'Email' ) !!}
            {!! BootstrapForm::password( 'password', 'Password' ) !!}
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
          {!! BootForm::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

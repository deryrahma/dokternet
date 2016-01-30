
@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
	
@endsection

@section( 'content' )
	<div class="container">
				<div class="row" style="margin-top: 30px">
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px" align="center">
							Ini halaman Login pasien
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px">
							<h2>Login Pasien</h2>
							<hr>
							@include('frontend.errors.session')
							{!! BootForm::open()->action(route('patient.login.post')) !!}
							<div class="box-body">
							    {!! BootstrapForm::text('email','Email') !!}
							    {!! BootstrapForm::password('password','Password') !!}
							</div><!-- /.box-body -->
							<div class="box-footer">
							    <button type="submit" class="btn btn-primary">Login</button>
							</div>
							{!! BootForm::close() !!}
						</div>
					</div>
				</div>
			</div>
@endsection
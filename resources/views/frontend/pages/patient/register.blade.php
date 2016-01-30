
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
							Ini halaman register pasien
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px">
							<h2>Pendaftaran Pasien</h2>
							<hr>
							@if( $data['content'] == null )
								{!! BootForm::open()->action(route('patient.post-register')) !!}
								{!! BootForm::bind( $data['content'] ) !!}
								@include('frontend.pages.patient.register-form')
								{!! BootForm::close() !!}
							@endif
						</div>
					</div>
				</div>
			</div>
@endsection
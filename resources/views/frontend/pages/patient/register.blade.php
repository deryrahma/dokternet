
@extends( 'frontend.app' )

@section( 'custom-head' )

@endsection

@section( 'custom-footer' )

@endsection

@section( 'content' )

<div class="row" >
	<div class="col-md-12 register-page">
		<div class="row">
			@if(Session::has('success'))
			<div class="col-md-12 register-content">
				<div class="alert alert-info alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Pendaftaran Berhasil!</strong>
				  {!! Session::get('success') !!}
				</div>
			</div>
			@endif
			<div class="col-xs-12 col-md-6 col-md-offset-3 register-content">
				<div class="panel register-panel">
						<h3 class="text-center">Daftar anggota <b class="dokternet-color">DokterNet</b></h3>
						<p class="text-center">
							Anda penyedia jasa kesehatan? <b><a href="{!! route('clinic.register') !!}">Klik Disini</a></b>
						</p>
						<hr>
						{!! BootForm::open()->action(route('patient.post-register')) !!}
						{!! BootForm::bind( $data['content'] ) !!}
						@include('frontend.pages.patient.register-form')
						{!! BootForm::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
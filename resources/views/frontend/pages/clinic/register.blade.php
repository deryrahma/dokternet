
@extends( 'frontend.app' )

@section( 'custom-head' )
{!! HTML::style('plugins/select2/css/select2.min.css') !!}
<style type="text/css">
	.footer{
		position: absolute;
	}
</style>
@endsection

@section( 'custom-footer' )
{!! HTML::script('plugins/select2/js/select2.full.min.js') !!}
<script type="text/javascript">
	$("#city").select2({
		allowClear: true,
		language: "id"
	});
	$("#specialization").select2({
		allowClear: true,
		language: "id"
	});

</script>
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
							Anda bukan penyedia jasa kesehatan? <b><a href="{!! route('patient.register') !!}">Klik Disini</a></b>
						</p>
						<hr>
						{!! BootForm::open()->action(route('clinic.post-register')) !!}
						<div class="form-group">
							<label class="control-label" for="">Lokasi:</label>
							<div class="input-group">
								<div class="input-group-addon dokternet-bg-yellow"><i class="fa fa-map-marker"></i></div>
								<select name="city_id" class="form-control" id="city">
									@foreach($data['city'] as $row)
									<option value="{!! $row->id !!}">
										{!! $row->name !!}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								{!! BootstrapForm::text('name','Nama Layanan Kesehatan') !!}				
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								{!! BootstrapForm::text('email','Email') !!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
						        {!! BootstrapForm::password('password','Password') !!}
						    </div>
						    <div class="col-md-6">
						        {!! BootstrapForm::password('cpassword','Konfirmasi Password') !!}
						    </div>
						</div>
						<div class="row">
					        <div class="col-md-12">
					            <p>
					            Dengan menekan daftar, saya mengkonfirmasi telah menyetujui Syarat & Ketentuan dan Kebijakan Privasi Dokternet 
					        </p>
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-md-12">
					            <button type="submit" class="btn btn-register btn-block">DAFTAR</button>
					        </div>
					    </div>
						{!! BootForm::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
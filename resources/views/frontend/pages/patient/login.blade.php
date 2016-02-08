
@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
	
@endsection

@section( 'content' )
<div class="row" >
	<div class="col-md-12 register-page">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3 register-content">
				<div class="panel register-panel">
					<h3 class="text-center">Masuk ke sistem <b class="dokternet-color">DokterNet</b></h3>
					<p  class="text-center">
						Segera dapatkan layanan perjanjian kesehatan secara online.
					</p>
					<hr>
					@include('frontend.errors.session')
					{!! BootForm::open()->action(route('patient.login.post')) !!}
					<div class="row">
						<div class="col-md-12">
					        {!! BootstrapForm::text('email','Email') !!}
					    </div>
				    </div>
				    <div class="row">
						<div class="col-md-12">    
						    {!! BootstrapForm::password('password','Password') !!}
						</div><!-- /.box-body -->
					</div>
					<div class="row">
				        <div class="col-md-12">
				            <button type="submit" class="btn btn-register btn-block">Masuk</button>
				        </div>
				        <div class="col-md-12">
				        	<p>
				        		<br>
				        		Belum memiliki akun? <a href="{!! route('patient.register') !!}"> Daftar </a>
				        	</p>
				        </div>
				    </div>
					{!! BootForm::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
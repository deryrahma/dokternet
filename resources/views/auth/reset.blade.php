
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
					<h3 class="text-center">Atur ulang password <b class="dokternet-color">DokterNet</b></h3>
					<hr>
					@include('frontend.errors.session')
					<form method="POST" action="{!! url('/password/reset') !!}">
					    {!! csrf_field() !!}
					    <input type="hidden" name="token" value="{{ $token }}">

					    @if (count($errors) > 0)
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    @endif

					    <div class="row">
							<div class="col-md-12">
						        {!! BootstrapForm::text('email','Email', old('email')) !!}
						    </div>
					    </div>
					    <div class="row">
							<div class="col-md-12">
						        {!! BootstrapForm::password('password','Password') !!}
						    </div>
					    </div>
					    <div class="row">
							<div class="col-md-12">
						        {!! BootstrapForm::password('password_confirmation','Konfirmasi Password') !!}
						    </div>
					    </div>
					    <div class="row">
					        <div class="col-md-6">
					            <button type="submit" class="btn btn-register btn-block">Reset Password</button>
					        </div>
					        <div class="col-md-6">
					        	<a href="{!! route('patient.login') !!}" class="btn btn-default btn-block">Kembali Login</a>
					        </div>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
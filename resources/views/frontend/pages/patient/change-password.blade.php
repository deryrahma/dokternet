
@extends( 'frontend.app' )

@section( 'custom-head' )
	{!! HTML::style('plugins/datepicker/bootstrap-datetimepicker.min.css') !!}
@endsection

@section( 'custom-footer' )
	{!! HTML::script('plugins/moment/moment.min.js') !!}
	{!! HTML::script('plugins/datepicker/bootstrap-datetimepicker.min.js') !!}
	<script type="text/javascript">
		$('#birth_date').datetimepicker({
			format:'YYYY-MM-DD'
		});
	</script>
@endsection

@section( 'content' )
	<div class="row">
		<div class="col-md-12 patient-page">
			<div class="row">
				<div class="col-md-4 sidebar-container">
					@include('frontend.pages.patient.sidebar')
				</div>
				<div class="col-md-8">
					<div class="row">
						<h3>
							Ganti Password
						</h3>
						<div class="col-md-12">
						@include('errors.session')
						</div>
						<div class="col-md-12 dashboard-profile">
							{!! BootstrapForm::open(['store' => 'patient.change-password.store']) !!}
							{!! BootstrapForm::password( 'oldpassword', 'Password lama' ) !!}
						    {!! BootstrapForm::password( 'password', 'Password baru' ) !!}
						    {!! BootstrapForm::password( 'cpassword', 'Konfirmasi password baru' ) !!}
						    <div class="row">
								<div class="col-md-3 col-md-offset-4">
									<button type="submit" class="btn btn-register btn-block">Ganti Password</button>
								</div>
							</div>
							{!! BootstrapForm::close() !!}
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection
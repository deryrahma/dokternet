
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
							Profile
						</h3>
						<div class="col-md-12">
						@include('errors.session')
						</div>
						<div class="col-md-12 dashboard-profile">
							{!! BootstrapForm::open(['model' => $data['content'], 'update' => 'patient.update']) !!}
								@include('frontend.pages.patient.patient-form')
							{!! BootstrapForm::close() !!}
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection
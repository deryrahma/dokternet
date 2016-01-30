
@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
	
@endsection

@section( 'content' )
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				@include('frontend.pages.patient.sidebar')
			</div>
			<div class="col-md-8">
				<h3>
					Profile
				</h3>
				<div class="col-md-12">
					{!! BootstrapForm::open(['model' => $data['content'], 'update' => 'patient.update']) !!}
						@include('frontend.pages.patient.patient-form')
					{!! BootstrapForm::close() !!}
				</div>
			</div>
		</div>			
	</div>
@endsection
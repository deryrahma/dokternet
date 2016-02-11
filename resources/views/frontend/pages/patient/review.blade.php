
@extends( 'frontend.app' )

@section( 'custom-head' )
@endsection

@section( 'custom-footer' )
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
							Tulis Ulasan
						</h3>
						<div class="col-md-12">
						@include('errors.session')
						</div>
						<div class="col-md-12 dashboard-profile">
							{!! Form::open(['url' => route('doctor.review.create', $data['content']->id), 'method' => 'post']) !!}
				        	@include('frontend.pages.review.form')
				        	{!! BootstrapForm::close() !!}
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection
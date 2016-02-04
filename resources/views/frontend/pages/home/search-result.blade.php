@extends( 'frontend.app' )

@section( 'custom-head' )
	{!! HTML::style('plugins/select2/css/select2.min.css') !!}
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
	<div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-9">
			<ul>
			@foreach($data['content'] as $specialization)
				@if($specialization->doctors->count() > 0)
				@foreach($specialization->doctors as $doctor)
				<li>
					<h2>
					<a href="{!! route('doctor.search-profile', urlencode($doctor->name)) !!}">
						{!! $doctor->name !!}
					</a>
					</h2>
					<h3>{!! $specialization->name !!}</h3>
				</li>
				@endforeach
				@endif
			@endforeach
			</ul>
		</div>
	</div>
@endsection
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
		 $("#advanceSearch").hide();
		 $("#advanceSearchBtn").click(function() {
		 	$("#advanceSearch").fadeToggle( "slow", "linear" );
		 });
		 
	</script>
@endsection

@section( 'content' )
	<div class="row">
		<div class="col-md-12 search-bg">
			{!! Form::open(['method' => 'GET', 'url' => route('search.doctor'), 'class' => '']) !!}
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon dokternet-bg-yellow"><i class="fa fa-map-marker"></i></div>
							<select name="city" class="form-control" id="city">
								@foreach($data['city'] as $row)
								<option value="{!! urlencode($row->name) !!}">
									{!! $row->name !!}
								</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon dokternet-bg-yellow"><i class="fa fa-tasks"></i></div>
							<select name="specialization" class="form-control" id="specialization">
								@foreach($data['specialization'] as $row)
								<option value="{!! urlencode($row->name) !!}">
									{!! $row->name !!}
								</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						{!! Form::text('keyword',$data['keyword'], array('placeholder' => 'Nama Dokter, Nama Rumah Sakit, dll', 'class' => 'form-control')) !!}
					</div>
				</div>	
				<div class="col-md-2">
					<button class="btn btn-dokternet" type="submit">
						CARI DOKTER
						<i class="fa fa-arrow-circle-right"></i>
					</button>
					
				</div>
				<div class="col-md-1">
					<a href="javascript:void(0)" class="btn btn-default btn-advance-search" data-toggle="tooltip" title="Lanjutan" id="advanceSearchBtn"><i class="fa fa-sliders"></i></a>
				</div>
			</div>
			<div class="row" id="advanceSearch">
				<div class="col-md-8">
					<div class="form-group">
						<label class="control-label" for="">Jadwal Praktek :</label>
						<div class="checkbox">
						@foreach($data['days'] as $key => $value)
						<label class="checkbox-inline">
						  <input name="practice_day[]" type="checkbox"  value="{!! $key !!}"> {!! $value !!}
						</label>
						@endforeach
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="">Jenis Kelamin :</label>
						<select class="form-control" name="gender">
							<option value="">Semua</option>
							<option value="L">Laki-laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
		<div class="col-md-12 section-search-result">
			<ul class="list-search-result">
			@foreach($data['content'] as $specialization)
				@if($specialization->doctors->count() > 0)
				@foreach($specialization->doctors as $doctor)
				<li>
					<div class="col-md-2">
						<div class="search-result-image-doctor">
							@if(File::exists('data/doctor/'.$doctor->photo) and !empty($doctor->photo))
							<img src="{!! asset('data/doctor/'.$doctor->photo) !!}" class="img-responsive img-thumbnail">
							@else
							<img src="{!! asset('img/doctor.png') !!}" class="img-responsive img-thumbnail">
							@endif
						</div>
					</div>
					<div class="col-md-10">
						<h3 class="name">
						<a href="{!! route('doctor.search-profile', urlencode($doctor->name)) !!}">
							{!! $doctor->name !!}
						</a>
						<div class="search-doctor-detail">
							<div class="">
								<div class="speciality">
									{!! $specialization->name !!}
									<?php 
									$rate = 0;
									foreach ($doctor->reviews as $row) {
										$rate += intval($row->rating);
									}
									if($rate > 0)
										$rate /= $doctor->reviews->count();
									$rate = intval($rate);
									?>
									
										<ul class="list-rating list-inline">
										@for($i = 1; $i <= 5; $i++)
											@if($i <= $rate)
											<li><i class="fa fa-star"></i></li>
											@else
											<li><i class="fa fa-star-o"></i></li>
											@endif
										@endfor
										</ul>
									
								</div>
							</div>
							<div class="address">
								<i class="fa fa-map-marker"></i> {!! $doctor->clinics->first()->name !!}
							</div>
							<div class="address">
								{!! $doctor->address !!}
							</div>
						</div>	
					</div>
				</li>
				@endforeach
				@endif
			@endforeach
			</ul>
		</div>
	</div>
@endsection
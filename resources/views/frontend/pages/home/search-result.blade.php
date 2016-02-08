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
		 @if(empty($data['gender_k']) and empty($data['practice_day_k']))
		 $("#advanceSearch").hide();
		 @endif
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
						  <input name="practice_day[]" type="checkbox"  value="{!! $key !!}" @if(!empty($data['practice_day_k']) and in_array($key, $data['practice_day_k'])) checked="true" @endif> {!! $value !!}
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
							<option value="L"  @if(!empty($data['gender_k']) and $data['gender_k'] == 'L') selected="true" @endif >Laki-laki</option>
							<option value="P" @if(!empty($data['gender_k']) and $data['gender_k'] == 'P') selected="true" @endif>Perempuan</option>
						</select>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
		<div class="col-md-12 section-search-result">
			<div class="row list-search-result">
			
				@foreach($data['content'] as $doctor)
				<div class="col-md-6 item">
					<div class="row">
						<div class="col-md-4">
							<div class="search-result-image-doctor">
							<a href="{!! route('doctor.search-profile', urlencode($doctor->name)) !!}">
								@if(File::exists('data/doctor/'.$doctor->photo) and !empty($doctor->photo))
								<img src="{!! asset('data/doctor/'.$doctor->photo) !!}" class="img-responsive img-thumbnail">
								@else
								<img src="{!! asset('img/doctor.png') !!}" class="img-responsive img-thumbnail">
								@endif
							</a>
							</div>
						</div>
						<div class="col-md-8">
							<h3 class="name">
							<a href="{!! route('doctor.search-profile', urlencode($doctor->name)) !!}">
								{!! $doctor->name !!}
							</a>
							</h3>
							<div class="search-doctor-detail">
								<div class="">
									<div class="speciality">
										{!! $doctor->specialization->name !!}
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
									{!! $doctor->clinics->first()->address !!}
								</div>
								<div class="practice_time">
									<i class="fa fa-clock-o"></i> 
									@if($doctor->day()->count() >0 )
										<?php 
										$days = array();
										$no = 0;
										$ind = 0;
										$tmp = array();
										$prev = "";
										?>
										@foreach($doctor->day as $row)
											<?php
											$ind++; 
											if($no == 0)
											{
												$no = $row->id;
												array_push($tmp, $row->name);
												$prev = "";
											}elseif ($row->id == ($no+1)) {
												$prev = $row->name;
												$no = $row->id;
											}else{
												if(!empty($prev))
												{
													array_push($tmp, $prev);
													array_push($days, implode('-', $tmp));
													while (!empty($tmp)) {
														array_pop($tmp);
													}
													
												}else{
													array_push($days, array_pop($tmp));
												}
												$no = $row->id;
												array_push($tmp, $row->name);
												$prev = "";
											}

											if($ind == $doctor->day()->count()){
												if(!empty($prev))
												{
													array_push($tmp, $prev);
													array_push($days, implode('-', $tmp));
													while (!empty($tmp)) {
														array_pop($tmp);
													}
												}else{

													array_push($days, array_pop($tmp));
												}
											}
											?>
										@endforeach
										{!! implode(', ', $days) !!}
									@endif
								</div>
							</div>	
						</div>
					</div>
					<div class="row btn-action">
						<div class="col-md-3">
							<a href="{!! route('doctor.search-profile', urlencode($doctor->name)) !!}" class="btn btn-default pull-right">
							Lihat Profil	
							</a>
						</div>
						<div class="col-md-3">
							<a class="btn btn-primary" href="{!! route('doctor.search-profile', urlencode($doctor->name)) !!}">
							Book Perjanjian
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-md-12">
					{!! $data['content']->render() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
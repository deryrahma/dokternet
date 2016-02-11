@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
@endsection

@section( 'content' )
	<div class="row">
		<div class="col-md-12 search-profile">
			<div class="col-md-5">
				<div class="col-md-4">
					<div class="image">
						@if(File::exists('data/doctor/'.$data['content']->photo) and !empty($data['content']->photo))
                            <img src="{!! asset('data/doctor/'.$data['content']->photo) !!}" class="img-responsive img-thumbnail">
                        @else
                            <img src="{!! asset('img/doctor.png') !!}" class="img-responsive img-thumbnail">
                        @endif
					</div>
				</div>
				<div class="col-md-8">
					<!-- <div class="row">
						<div class="col-md-10">
							<h3>
								{!! $data['content']->name !!}
							</h3>
						</div>
						<div class="col-md-2">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#reviewModal" class="btn btn-danger"><i class="fa fa-share-square-o fa-lg"></i></a>
						</div>
					</div> -->
					<h3>
								{!! $data['content']->name !!}
							</h3>
					<p>
						{!! $data['content']->specialization->name !!}
						<?php 
						$rate = 0;
						foreach ($data['content']->reviews as $row) {
							$rate += intval($row->rating);
						}
						if($rate > 0)
							$rate /= $data['content']->reviews->count();
						$rate = intval($rate);
						?>
						<p>
							<ul class="list-rating list-inline">
							@for($i = 1; $i <= 5; $i++)
								@if($i <= $rate)
								<li><i class="fa fa-star"></i></li>
								@else
								<li><i class="fa fa-star-o"></i></li>
								@endif
							@endfor
							</ul>
							({!! $data['content']->reviews->count() !!} ulasan)
						</p>
					</p>
					<p>
						<i class="fa fa-credit-card"> </i> {!! $data['content']->registration_number !!} ({!! $data['content']->registration_year !!})
					</p>
					<p>
						<i class="fa fa-envelope-o"> </i><a href="mailto:{!! $data['content']->user->email !!}"> {!! $data['content']->user->email !!}</a>
					</p>
					
				</div>
				<div class="col-md-12">
					<p>
						{!! $data['content']->profile !!}
					</p>
					<div>
						<h4 class="blue-dokternet lead-text">Tempat Praktek</h4>
						<ul class="list-inline">
							@foreach($data['content']->clinics as $clinic)
							<li>
								{!! $clinic->name !!}
							</li>
							@endforeach
						</ul>
					</div>
					<div class="education ">
						<h4 class="blue-dokternet lead-text">Pendidikan</h4>
						<ol>
							@foreach($data['content']->doctorEducation as $row)
								<li>{!! $row->year !!} - {!! $row->name !!}</li>
							@endforeach
						</ol>
					</div>
					<div class="history_clinic">
						
					</div>
				</div>
			</div>
			
			<div class="col-md-7">
				<h4  class="blue-dokternet lead-text">
					Jadwal Praktek
				</h4>
				<blockquote>
				  <p>
				  Pilih slot tersedia untuk melakukan perjanjian online.
				  </p>
				</blockquote>
				<table class="table schedule-practice">
			        <tbody>
			          @for( $i = 0; $i <= 7; $i++ )
			            <tr height="">
			              <td class="col-md-2 col-xs-2">{{ date( "l, d M Y", strtotime( "+".$i." day" ) ) }}</td>
			              <td class="col-md-10 col-xs-10">
			                @foreach( $data['schedule'][$i] as $row )
			                  <a href="{{ route( 'reservation.book', ['id' => $row->id] ) }}" class="btn btn-default" {{ ( $row->status_batal == "1" || $row->quota == 0 ) ? "disabled=disabled style=text-decoration:line-through" : '' }}>
			                    {{ $row->schedule_start }} - {{ $row->schedule_end }}<br>
			                    <small>Kuota tersedia: {{ $row->quota }}</small><br>
			                  </a>
			                @endforeach
			              </td>
			            </tr>
			          @endfor
			        </tbody>
			    </table>
			</div>
		</div>
	</div>

<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="reviewModalLabel">
        	Tuliskan Ulasan
        </h4>
      </div>
      <div class="modal-body">
        @if(!Auth::check())
        	<p>
        		Anda harus login terlebih dahulu. Klik <a href="{!! routes('patient.login') !!}">disini</a> untuk login.
        	</p>
        @elseif(Auth::user()->roles->first()->level == '2')
        	{!! BootstrapForm::open(['model' => $data['content'], 'store' => 'clinic.doctor.store', 'update' => 'clinic.doctor.update','files' => true]) !!}
        	@include('frontend.pages.review.form')
        	{!! BootstrapForm::close() !!}
        @else
        	<p>
        		Anda tidak berhak mengisi tulisan ulasan.
        	</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
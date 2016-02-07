@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
@endsection

@section( 'content' )
	<div class="row">
		<div class="col-md-12 search-profile">
			<div class="col-md-6">
				<div class="col-md-4">
					<div class="image">
						<img src="{!! asset('data/doctor/'.$data['content']->photo) !!}" class="img-responsive">
					</div>
				</div>
				<div class="col-md-8">
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
					<div>
						<h4>Tempat Praktek</h4>
						<ul class="list-inline">
							@foreach($data['content']->clinics as $clinic)
							<li>
								{!! $clinic->name !!}
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-md-12">
					<h3>Kualifikasi Dokter</h3>
					<div class="education">
						
					</div>
					<div class="history_clinic">
						
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<table border="1" width="100%">
			        <tbody>
			          @for( $i = 0; $i <= 7; $i++ )
			            <tr height="">
			              <td class="col-md-2 col-xs-2">{{ date( "Y-m-d", strtotime( "+".$i." day" ) ) }}</td>
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
@endsection